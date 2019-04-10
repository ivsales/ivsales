<?php

namespace IVSales;

use Illuminate\Database\Eloquent\Model;

/**
 * IVSales\Brand
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\IVSales\Product[] $products
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Brand whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Brand whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Brand whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Brand extends Model
{
    protected $fillable = [
        'title', 'alias'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getForMenuWithCountProducts(Menu $menu)
    {
        return $this
            ->whereIn('brands.id', $menu->products->pluck('brand_id')->unique())
            ->withCount(['products' => function ($query) use ($menu) {
                $query
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->where('categories.menu_id', $menu->id);
            }])
            ->get();
    }

    public function getForCategoryWithCountProducts(Category $category)
    {
        return $this
            ->whereIn('brands.id', $category->products->pluck('brand_id')->unique())
            ->withCount(['products' => function ($query) use ($category) {
                $query->where('category_id', $category->id);
            }])
            ->get();
    }
}
