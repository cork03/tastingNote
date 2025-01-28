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
        Schema::create('blind_tasting_wine_varieties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blind_tasting_answer_id')->comment('ブラインドテイスティング回答ID')->constrained(indexName: 'blind_tasting_wine_varieties_answer_id_foreign');
            $table->foreignId('grape_variety_id')->comment('ブドウ品種ID')->constrained(indexName: 'blind_tasting_wine_varieties_variety_id_foreign');
            $table->tinyInteger('percentage')->unsigned()->comment('割合');
            $table->unique(
                columns: ['blind_tasting_answer_id', 'grape_variety_id'],
                name: 'blind_tasting_wine_varieties_answer_variety_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blind_tasting_wine_varieties');
    }
};
