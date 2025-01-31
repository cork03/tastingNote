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
        Schema::table('producers', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });
        Schema::table('producers', function (Blueprint $table) {
            $table->foreignId("country_id")->nullable(false)->comment("国ID")->change();
            $table->foreign("country_id")->references("id")->on("countries");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('producers', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });
        Schema::table('producers', function (Blueprint $table) {
            $table->foreignId("country_id")->nullable()->comment("国ID")->change();
            $table->foreign("country_id")->references("id")->on("countries");
        });
    }
};
