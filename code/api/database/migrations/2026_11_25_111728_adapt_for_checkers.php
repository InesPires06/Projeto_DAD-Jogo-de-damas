<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('rank_points')->default(1000);
        });

        Schema::table('games', function (Blueprint $table) {
            $table->enum('game_type', ['casual', 'ranked', 'tournament'])->default('casual');
            $table->unsignedInteger('stake')->default(0);
            $table->unsignedBigInteger('tournament_id')->nullable();
            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->unsignedTinyInteger('round')->nullable();
            $table->string('end_reason', 30)->nullable();
            $table->boolean('is_bot')->default(false);
            $table->json('moves')->nullable();
        });

        DB::table('coin_transaction_types')->insert([
            ['name' => 'Withdraw', 'type' => 'D'],          // id = 7
            ['name' => 'Tournament fee', 'type' => 'D'],    // id = 8
            ['name' => 'Tournament prize', 'type' => 'C'],  // id = 9
        ]);
    }

    public function down(): void
    {
        DB::table('coin_transaction_types')->whereIn('name', ['Withdraw', 'Tournament fee', 'Tournament prize'])->delete();

        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign(['tournament_id']);
            $table->dropColumn(['game_type', 'stake', 'tournament_id', 'round', 'end_reason', 'is_bot', 'moves']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rank_points');
        });
    }
};