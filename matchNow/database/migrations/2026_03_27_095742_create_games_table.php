<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();

            $table->foreignId('team1_id')->constrained('teams');
            $table->foreignId('team2_id')->nullable()->constrained('teams');

            $table->foreignId('terrain_id')->constrained();

            $table->dateTime('match_date');

            $table->string('status')->default('pending'); // pending / accepted

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
