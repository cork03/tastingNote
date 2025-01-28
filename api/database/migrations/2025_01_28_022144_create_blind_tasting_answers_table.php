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
        Schema::create('blind_tasting_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wine_comment_id')->comment('ワインコメントID')->constrained();
            $table->foreignId('country_id')->comment('国ID')->constrained();
            $table->integer('vintage')->comment('ヴィンテージ');
            $table->integer('price')->comment('価格');
            $table->decimal('alcohol_content', 3, 1)->comment('アルコール度数');
            $table->text('another_comment')->comment('その他コメント')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blind_tasting_answers');
    }
};
