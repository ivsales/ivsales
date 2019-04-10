<?php

namespace IVSales;

use IVSales\Components\Cart\Cart;
use IVSales\Components\Money\Money;
use IVSales\Components\Money\Currency;
use IVSales\Components\Money\Exchanger;
use Illuminate\Database\Eloquent\Model;

/**
 * IVSales\Product
 *
 * @property int $id
 * @property string $title
 * @property Money $price
 * @property Money|null $old_price
 * @property int $quantity
 * @property int $is_top
 * @property int $is_new
 * @property string $img
 * @property string $description
 * @property int $category_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $brand_id
 * @property-read \IVSales\Brand $brand
 * @property-read \IVSales\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereIsTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\IVSales\Review[] $reviews
 * @property float $weight
 * @property float $width
 * @property float $height
 * @property float $length
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Product whereWidth($value)
 */
class Product extends Model
{
    protected $perPage = 6;

    protected $fillable = [
        'title', 'price', 'old_price', 'quantity', 'description', 'is_top', 'is_new', 'img', 'category_id', 'brand_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getImgAttribute(string $value): string
    {
        if (preg_match('~^http~', $value)) {
            return $value;
        }
        return '/images/products/' . $value;
    }

    /**
     * @param int $value
     * @return Money
     */
    public function getPriceAttribute(int $value): Money
    {
        $exchanger = app(Exchanger::class);
        return $exchanger->convert(Money::USD($value), app(Currency::class));
    }

    /**
     * @param int|null $value
     * @return Money|null
     */
    public function getOldPriceAttribute(?int $value): ?Money
    {
        $exchanger = app(Exchanger::class);
        return is_null($value)
            ? null
            : $exchanger->convert(Money::USD($value), app(Currency::class));
    }

    public function outOfStock(): bool
    {
        return $this->quantity === 0;
    }

    public function hasLowStock(): bool
    {
        return $this->quantity > 0 && $this->quantity < 10;
    }

    public function hasStock(int $quantity): bool
    {
        return $this->quantity >= $quantity;
    }

    public function hasFreeStock(Cart $cart): bool
    {
        return ! ($this->outOfStock() || ($cart->has($this) && $cart->freeQuantity($this) === 0));
    }

    public function getForMainPageWhere(string $field)
    {
        return $this
            ->where($field, 1)
            ->with('reviews')
            ->inRandomOrder()
            ->take(4)
            ->get();
    }

    public function getWhereMenu(
        Menu $menu, ?string $brand = null, string $orderBy = 'desc', string $column = 'id', ?array $price = null
    ) {
        $data = $this
            ->whereIn('category_id', Category::select('id')->whereMenuId($menu->id)->get())
            ->with('reviews')
            ->orderBy($column, $orderBy);
        if ($brand) {
            $data->whereBrandId(Brand::whereAlias($brand)->first()->id);
        }
        if ($price) {
            [$minPrice, $maxPrice] = $this->getPriceRange($price);
            $data->whereBetween('price', [$minPrice, $maxPrice]);
        }
        return $data->paginate();
    }

    public function getWhereCategory(
        Category $category, ?string $brand = null, string $orderBy = 'desc', string $column = 'id', ?array $price = null
    ) {
        $data = $this
            ->whereCategoryId($category->id)
            ->with('reviews')
            ->orderBy($column, $orderBy);
        if ($brand) {
            $data->whereBrandId(Brand::whereAlias($brand)->first()->id);
        }
        if ($price) {
            [$minPrice, $maxPrice] = $this->getPriceRange($price);
            $data->whereBetween('price', [$minPrice, $maxPrice]);
        }
        return $data->paginate();
    }

    public function getMaxPrice(Menu $menu, Exchanger $exchanger, ?Category $category = null): int
    {
        $data = $this
            ->whereIn('category_id', Category::select('id')->whereMenuId($menu->id)->get());
        if ($category) {
            $data->whereCategoryId($category->id);
        }
        $maxPrice = $exchanger->convert(Money::USD($data->max('price')), app(Currency::class))
            ->format();
        return ceil($maxPrice);
    }

    private function getPriceRange(array $price): array
    {
        $exchanger = app(Exchanger::class);
        $currency = app(Currency::class);
        $minPrice = $exchanger->convert(
            (new Money($price['min'], app(Currency::class)))->mul($currency->getCountSubUnitsInUnit()),
            Currency::USD()
        );
        $maxPrice = $exchanger->convert(
            (new Money($price['max'], app(Currency::class)))->mul($currency->getCountSubUnitsInUnit()),
            Currency::USD()
        );
        return [$minPrice->getAmount(), $maxPrice->getAmount()];
    }

    public function searchTooltips(string $query): array
    {
        $result = $this
            ->where('title', 'like', $query . '%')
            ->get();
        return $result->pluck('title')->all();
    }

    public function search(string $query)
    {
        $query = str_replace(['_', '%'], ['\_', '\%'], $query);
        return $this
            ->where('title', 'like', '%' . $query . '%')
            ->get();
    }
}
