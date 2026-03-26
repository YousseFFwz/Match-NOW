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
        Schema::create('profiles', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained()->cascadeOnDelete();

        $table->string('avatar')->nullable();
        $table->integer('age')->nullable();
        $table->string('position')->nullable();
        $table->string('preferred_foot')->nullable();
        $table->float('height')->nullable();
        $table->float('weight')->nullable();

        $table->foreignId('team_id')->nullable()->constrained()->nullOnDelete();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
