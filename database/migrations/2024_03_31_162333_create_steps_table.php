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
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->string('goal')->nullable();
            $table->string('current')->nullable();
            $table->string('kkal')->nullable();
            $table->string('distance')->nullable();
            $table->dateTime('achieved_at')->nullable();
            $table->dateTime('date')->nullable();
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
        Schema::dropIfExists('steps');
    }
};
