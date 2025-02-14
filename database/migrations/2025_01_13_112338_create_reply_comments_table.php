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
        Schema::create('reply_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('post_id')->nullable();
            $table->integer('comment_id')->nullable();
            $table->string('user_name')->nullable();
            $table->text('reply')->nullable();
            $table->integer('activ')->nullable();
            $table->integer('num')->nullable();
            $table->string('id_user')->nullable();
            $table->text('stuff')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reply_comments');
    }
};
