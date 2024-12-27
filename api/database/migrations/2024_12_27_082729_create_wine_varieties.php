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
        Schema::create('wine_varieties', function (Blueprint $table) {
            $table->id();
            $table->foreignId("wine_id")->constrained();
            $table->foreignId("grape_variety_id")->constrained();
            $table->unique(["wine_id", "grape_variety_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wine_varieties');
    }
};
