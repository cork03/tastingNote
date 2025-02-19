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
        Schema::create('appellation_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('原産地統制呼称のタイプ(AOC, DOC, etc)');
            $table->foreignId('country_id')->comment('国id')->constrained();
            $table->unique(['name', 'country_id']);
        });
        Schema::create('appellations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('地域名');
            $table->foreignId('appellation_type_id')->comment('原産地統制呼称のタイプid')->constrained();
            $table->text('regulation')->comment('規定');
            $table->unique(['name', 'appellation_type_id']);
        });
        Schema::table('wines', function (Blueprint $table) {
            $table->foreignId('appellation_id')->nullable()->comment('アペラシオンid')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wines', function (Blueprint $table) {
            $table->dropConstrainedForeignId('appellation_id');
        });
        Schema::dropIfExists('appellations');
        Schema::dropIfExists('appellation_types');
    }
};
