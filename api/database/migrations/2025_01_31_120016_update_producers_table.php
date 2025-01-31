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
            $table->foreignId("country_id")->nullable()->comment("国ID")->constrained();
            $table->text("description")->comment("説明");
            $table->string("url")->comment("URL")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('producers', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropColumn("country_id");
            $table->dropColumn("description");
            $table->dropColumn("url");
        });
    }
};
