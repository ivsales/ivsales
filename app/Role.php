<?php

namespace IVSales;

use Illuminate\Database\Eloquent\Model;

/**
 * IVSales\Role
 *
 * @property int $id
 * @property string $title
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Role whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends Model
{
    protected $fillable = ['title'];

    public function users()
    {
        $this->hasMany(User::class);
    }
}
