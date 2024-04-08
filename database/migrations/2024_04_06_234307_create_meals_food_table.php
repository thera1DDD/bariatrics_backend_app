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
        Schema::create('meals_food', function (Blueprint $table) {
            $table->id();
            $table->string('quantity')->nullable();
            $table->foreignId('meals_id')->nullable()->constrained('meals')->onDelete('cascade');
            $table->foreignId('foods_id')->nullable()->index()->constrained('food')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals_food');
    }
};
