<?php

namespace IVSales\Components\Cart;

use IVSales\Components\Money\Currency;
use IVSales\Components\Money\Exchanger;
use IVSales\Components\Money\Money;
use IVSales\Exceptions\QuantityOverstated;
use IVSales\Product;
use IVSales\Repositories\Cart\RepositoryContract as Repository;
use Illuminate\Support\Collection;

class Cart
{
    /**
     * @var Repository
     */
    private $repository;

    /**
     * @var CartItemCreator
     */
    private $creator;

    /**
     * @var Calculator
     */
    private $calculator;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var Exchanger
     */
    private $exchanger;

    public function __construct(
        Repository $repository, CartItemCreator $creator, Currency $currency, Calculator $calculator, Exchanger $exchanger
    ) {
        $this->repository = $repository;
        $this->creator = $creator;
        $this->currency = $currency;
        $this->calculator = $calculator;
        $this->exchanger = $exchanger;
    }

    /**
     * @param Product $product
     * @param int $quantity
     * @throws QuantityOverstated
     */
    public function add(Product $product, int $quantity)
    {
        if ($this->has($product)) {
            $quantity += $this->get($product)->quantity;
        }
        if ($quantity <= 0) {
            $this->remove($product);
            return;
        }
        if (! $product->hasStock($quantity)) {
            throw new QuantityOverstated;
        }
        $this->update($product, $quantity);
    }

    private function update(Product $product, int $quantity)
    {
        $this->repository->set($product->id, $this->creator->factory($product, $quantity));
    }

    public function get(Product $product): ?CartItem
    {
        return $this->repository->get($product->id);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function remove(Product $product)
    {
        $this->repository->unset($product->id);
    }

    public function clear()
    {
        $this->repository->clear();
    }

    public function has(Product $product): bool
    {
        return $this->repository->exists($product->id);
    }

    public function count(): int
    {
        return $this->all()->count();
    }

    public function isNotEmpty(): bool
    {
        return $this->all()->isNotEmpty();
    }

    public function freeQuantity(Product $product): int
    {
        return $product->quantity - $this->get($product)->quantity;
    }

    public function setShipping(?Money $price)
    {
        $this->repository->setShippingPrice($price);
    }

    public function getShipping(): ?Money
    {
        return $this->hasShipping()
            ? $this->exchanger->convert($this->repository->getShippingPrice(), $this->currency)
            : null;
    }

    public function hasShipping(): bool
    {
        return ! is_null($this->repository->getShippingPrice());
    }

    public function getShippingInUSD()
    {
        return $this->hasShipping()
            ? $this->exchanger->convert($this->repository->getShippingPrice(), Currency::USD())
            : null;
    }

    public function totalQuantity(): int
    {
        return $this->calculator->totalQuantity($this->all());
    }

    public function totalPrice(): Money
    {
        return $this->calculator->totalPrice($this->all(), $this->currency);
    }

    public function totalWeight(): float
    {
        return $this->calculator->totalWeight($this->all());
    }

    public function totalDimensions(): float
    {
        return $this->calculator->totalDimensions($this->all());
    }

    /**
     * @return Money
     * @throws \IVSales\Exceptions\DifferentCurrencies
     */
    public function totalPriceWithShipping(): Money
    {
        return $this->hasShipping()
            ? $this->totalPrice()->add($this->getShipping())
            : $this->totalPrice();
    }

    public function purchaseProducts(): void
    {
        $idsAndQuantity = $this->getIdsAndQuantityProducts();
        $products = Product::find($idsAndQuantity->pluck('id'));
        $products->each(function (Product $item) use ($idsAndQuantity) {
            $quantity = $item->quantity - $idsAndQuantity->get($item->id)['qty'];
            if ($quantity < 0) {
                $this->update($item, $item->quantity);
                throw new QuantityOverstated($item->id);
            }
            $item->quantity = $quantity;
        });
        $products->each(function (Product $item) {
            $item->save();
        });
    }

    private function getIdsAndQuantityProducts(): Collection
    {
        $collection = collect();
        $this->all()->each(function (CartItem $item, $i) use ($collection) {
            $collection->put($i, ['id' => $item->product->id, 'qty' => $item->quantity]);
        });
        return $collection;
    }
}