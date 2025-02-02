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
        Schema::table('wine_vintages', function (Blueprint $table) {
            $table->text('image_path')->comment('画像パス')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wine_vintages', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
};
