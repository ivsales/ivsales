<?php

namespace IVSales\Repositories\Cart;

use IVSales\Components\Cart\CartItem;
use IVSales\Components\Money\Money;
use Illuminate\Support\Collection;

interface RepositoryContract
{
    public function get(int $key);

    public function set(int $key, CartItem $value);

    public function all(): Collection;

    public function exists(int $key): bool;

    public function unset(int $key);

    public function clear();

    public function setShippingPrice(?Money $price);

    public function getShippingPrice(): ?Money;
}