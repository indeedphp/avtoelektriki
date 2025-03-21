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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('index')->default(0);
            $table->integer('channel')->default(0);
            $table->integer('post')->default(0);
            $table->integer('cabinet')->default(0);
            $table->integer('site')->default(0);
            $table->integer('complaints')->default(0);
            $table->integer('admin')->default(0);
            $table->integer('bot_start')->default(0);
            $table->integer('bot_post')->default(0);
            $table->integer('bot_1')->default(0);
            $table->integer('bot_2')->default(0);
            $table->integer('bot_3')->default(0);
            $table->integer('smart')->default(0);
            $table->integer('pc')->default(0);
            $table->integer('ad')->default(0);
            $table->integer('num')->default(0);
            $table->text('stuff')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
