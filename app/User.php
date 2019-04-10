<?php

namespace IVSales;

use IVSales\Events\ConfirmEmail;
use IVSales\Events\UserRegistered;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * IVSales\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\IVSales\Article[] $articles
 * @property-read \Illuminate\Database\Eloquent\Collection|\IVSales\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\IVSales\Review[] $reviews
 * @property int $verified
 * @property string|null $confirm_token
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\User whereConfirmToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\User whereVerified($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\IVSales\Order[] $orders
 * @property string|null $surname
 * @property string|null $patronymic
 * @property int|null $phone_number
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\User wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\User whereSurname($value)
 * @property-read string $full_name
 * @property int $role_id
 * @property-read \IVSales\Role $role
 * @method static \Illuminate\Database\Eloquent\Builder|\IVSales\User whereRoleId($value)
 */
class User extends Authenticatable
{
    use Notifiable;

    protected const EMAIL_CONFIRMED = true;
    protected const EMAIL_NOT_CONFIRMED = false;
    protected const TOKEN_EXPIRED = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirm_token', 'verified', 'surname', 'patronymic', 'phone_number', 'role_id'
    ];

    protected $dispatchesEvents = [
        'created' => UserRegistered::class,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'full_name'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function confirmEmail()
    {
        $this->verified = self::EMAIL_CONFIRMED;
        $this->confirm_token = self::TOKEN_EXPIRED;
        $this->save();
        event(new ConfirmEmail($this));
        return $this;
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->surname . ' ' . $this->name . ' ' . $this->patronymic);
    }

    public function isAdmin(): bool
    {

        return $this->role->title === 'admin';
    }
}
