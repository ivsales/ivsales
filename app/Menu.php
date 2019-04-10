<?php

namespace IVSales;

use Illuminate\Database\Eloquent\Model;

/**
 * IVSales\Menu
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\IVSales\Category[] $categories
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Menu whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Menu whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Menu whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\IVSales\Product[] $products
 */
class Menu extends Model
{
    protected $fillable = [
        'title', 'alias'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Category::class);
    }

    public function getNavBar()
    {
        return $this
            ->with('categories')
            ->get();
    }

    public function getWithCountProducts()
    {
        return $this
            ->withCount('products')
            ->has('products')
            ->get();
    }
}
