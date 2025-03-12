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
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->string('address')->nullable();
            $table->string('sity')->nullable();
            $table->string('country')->nullable();
            $table->string('lang')->nullable();
            $table->string('avatar_user')->nullable();
            $table->string('avatar_channel')->nullable();
            $table->string('img_channel')->nullable();
            $table->string('color_channel')->nullable();
            $table->string('name_channel')->nullable();
            $table->string('definition_channel')->nullable();
            $table->string('date_channel')->nullable();
            $table->text('text_channel')->nullable();
            $table->integer('ban_channel')->nullable();
            $table->string('site_url')->nullable();
            $table->string('site_activ')->nullable();
            $table->string('bot_activ')->nullable();
            $table->string('bot_link_activ')->nullable();
            $table->string('location_n')->nullable();
            $table->string('location_e')->nullable();
            $table->integer('prof_level')->nullable();
            $table->string('side_url')->nullable();
            $table->string('date_1')->nullable();
            $table->string('date_2')->nullable();
            $table->integer('num')->nullable();
            $table->integer('activ')->nullable();
            $table->text('stuff')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_data');
    }
};
