<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
 * @property string $first_name
 * @property null|string $second_name
 * @property string $last_name
 * @property-read string $fio
 * @property string $phone
 * @property string $email
 * @property bool $is_blocked
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'second_name',
        'last_name',
        'phone',
        'email',
        'password',
        'is_blocked'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'createdAt',
        'updatedAt',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function booted(): void
    {
        static::creating(static function (User $user) {
            $user->setFioAttribute();
        });

        static::updating(static function (User $user) {
            $user->setFioAttribute();
        });
    }

    public function getNameAttribute(): string
    {
        return $this->fio;
    }

    public function setFioAttribute(): void
    {
        $this->fio = trim(trim($this->last_name . ' ' . $this->first_name) . ' ' . $this->second_name);
    }
}
