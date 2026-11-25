<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_draw' => 'boolean',
            'is_bot' => 'boolean',
            'moves' => 'array',
            'began_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    public function player1()
    {
        return $this->belongsTo(User::class, 'player1_user_id');
    }

    public function player2()
    {
        return $this->belongsTo(User::class, 'player2_user_id');
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_user_id');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}