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
        Schema::create('create_posts', function (Blueprint $table) {  // создаем таблицу в которой пост создается из бота
            $table->id();
            $table->string('user_name')->nullable();
            $table->string('id_user')->nullable();
            $table->text('name_post')->nullable();
            $table->string('url_foto_1')->nullable();
            $table->text('text_post_1')->nullable();
            $table->string('url_foto_2')->nullable();
            $table->text('text_post_2')->nullable();
            $table->string('url_foto_3')->nullable();
            $table->text('text_post_3')->nullable();
            $table->string('url_foto_4')->nullable();
            $table->text('text_post_4')->nullable();
            $table->string('url_foto_5')->nullable();
            $table->text('text_post_5')->nullable();
            $table->string('id_youtube')->nullable();
            $table->string('text_video')->nullable();
            $table->integer('step')->nullable();
            $table->integer('vid_step')->nullable();
            $table->string('stuff')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_posts');
    }
};
