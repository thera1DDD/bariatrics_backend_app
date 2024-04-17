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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('weight')->nullable();
            $table->integer('weight_before')->nullable();
            $table->integer('height')->nullable();
            $table->integer('age')->nullable();
            $table->string('role')->nullable();
            $table->dateTime('surgery_date')->nullable();
            $table->enum('gender',['male','female'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
