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
        Schema::create('wine_vintages', function (Blueprint $table) {
            $table->id();
            $table->comment("ワイン詳細");
            $table->foreignId("wine_id")->comment("ワインID")->constrained();
            $table->integer("vintage")->comment("ヴィンテージ");
            $table->integer("price")->comment("価格");
            $table->text("aging_method")->comment("熟成方法")->nullable();
            $table->decimal("alcohol_content", 3, 1)->comment("アルコール度数");
            $table->text("technical_comment")->comment("テクニカルコメント")->nullable();
            $table->timestamp("created_at")->comment("登録日時");
            $table->timestamp("updated_at")->comment("更新日時");
            $table->unique(["wine_id", "vintage"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wine_vintages');
    }
};
