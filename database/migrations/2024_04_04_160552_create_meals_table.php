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
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['breakfast','second','lunch','midday','dinner'])->nullable();
            $table->dateTime('meal_start_at')->nullable();
            $table->dateTime('meal_end_at')->nullable();
            $table->dateTime('ate_at')->nullable();
            $table->foreignId('users_id')
                ->nullable()
                ->index()
                ->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
