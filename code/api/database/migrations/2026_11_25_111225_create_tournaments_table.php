<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('entry_fee');
            $table->unsignedTinyInteger('max_players')->default(8);
            $table->enum('status', ['open', 'in_progress', 'ended', 'cancelled'])->default('open');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('winner_id')->nullable()->constrained('users');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
        });

        Schema::create('tournament_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('position')->nullable();
            $table->timestamps();
            $table->unique(['tournament_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournament_user');
        Schema::dropIfExists('tournaments');
    }
};