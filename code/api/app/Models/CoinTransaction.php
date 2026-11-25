<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoinTransaction extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'transaction_datetime' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(CoinTransactionType::class, 'coin_transaction_type_id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function purchase()
    {
        return $this->hasOne(CoinPurchase::class);
    }
}