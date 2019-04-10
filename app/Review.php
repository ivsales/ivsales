<?php

namespace IVSales;

use Illuminate\Database\Eloquent\Model;

/**
 * IVSales\Review
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property int $rating
 * @property string $name
 * @property int|null $user_id
 * @property int $product_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \IVSales\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Review whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Review whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Review whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Review whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Review whereUserId($value)
 * @mixin \Eloquent
 */
class Review extends Model
{
    protected $perPage = 5;

    protected $fillable = [
        'title', 'text', 'rating', 'name', 'user_id', 'product_id'
    ];

    public function product()
    {
        $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Product $product
     * @return float
     */
    public function getMaxOffset(Product $product): float
    {
        return $product->reviews->count() / $this->perPage;
    }

    public function getForProduct(Product $product, int $offset = 0)
    {
        return $this
            ->whereProductId($product->id)
            ->with('user')
            ->orderByDesc('id')
            ->offset($offset * $this->perPage)
            ->take($this->perPage)
            ->get();
    }
}
