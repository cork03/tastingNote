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
        Schema::create('wine_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wine_vintage_id')->nullable()->comment("ワインヴィンテージID")->constrained();
            $table->text('appearance')->comment("外観");
            $table->text('aroma')->comment("香り");
            $table->text('taste')->comment("味わい");
            $table->text('another_comment')->comment("その他コメント")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wine_comments');
    }
};
