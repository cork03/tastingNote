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
        Schema::create('wine_rankings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wine_vintage_id')->unique()->comment('ワインヴィンテージのid')->constrained();
            $table->integer('rank')->unique()->comment('順位');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wine_rankings');
    }
};
