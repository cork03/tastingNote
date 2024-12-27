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
        Schema::create('wines', function (Blueprint $table) {
            $table->comment("ワイン");
            $table->id();
            $table->string("name")->comment("ワイン名");
            $table->foreignId("producer_id")->comment("生産者ID")->constrained();
            $table->foreignId("wine_type_id")->comment("ワイン種別ID")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wines');
    }
};
