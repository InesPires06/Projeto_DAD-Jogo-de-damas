<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'coins_per_euro' => '10',
            'platform_fee_percent' => '10',
            'ranked_entry_fee' => '5',
            'welcome_bonus' => '50',
        ];
        foreach ($settings as $key => $value) {
            Setting::create(['key' => $key, 'value' => $value]);
        }

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'nickname' => 'admin',
            'type' => 'A',
        ]);

        $players = [
            ['Test User', 'test@example.com', 'test', 100, 1000],
            ['Second User', 'second@example.com', 'second', 100, 1000],
            ['Player 1', 'player1@example.com', 'player1', 200, 1100],
            ['Player 2', 'player2@example.com', 'player2', 200, 950],
        ];

        foreach ($players as [$name, $email, $nickname, $coins, $rank]) {
            User::factory()->create([
                'name' => $name,
                'email' => $email,
                'nickname' => $nickname,
                'type' => 'P',
                'coins_balance' => $coins,
                'rank_points' => $rank,
            ]);
        }
    }
}