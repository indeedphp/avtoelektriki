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
        Schema::table('posts', function (Blueprint $table) {
            $table->text('text_post_4')->nullable();
            $table->string('url_foto_4')->nullable();
            $table->text('text_post_5')->nullable();
            $table->string('url_foto_5')->nullable();
            $table->integer('bot')->default(0);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
        $table->dropColumn('text_post_4');
        $table->dropColumn('url_foto_4');
        $table->dropColumn('text_post_5');
        $table->dropColumn('url_foto_5');
        $table->dropColumn('bot');

    });
    }
};
// поменять местами фото и текст