<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password', 'nickname', 'type', 'blocked', 'photo_avatar_filename', 'coins_balance', 'rank_points'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'blocked' => 'boolean',
            'coins_balance' => 'integer',
            'rank_points' => 'integer',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->type === 'A';
    }

    public function transactions()
    {
        return $this->hasMany(CoinTransaction::class);
    }

    public function purchases()
    {
        return $this->hasMany(CoinPurchase::class);
    }

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class)->withPivot('position')->withTimestamps();
    }
}