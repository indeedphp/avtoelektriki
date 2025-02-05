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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->nullable();
            $table->string('id_user')->nullable();
            $table->string('id_chat')->nullable();
            $table->string('color_head')->nullable();
            $table->text('heading')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('color_body')->nullable();
            $table->string('color_card')->nullable();
            $table->text('top_text')->nullable();
            $table->text('text_1_a')->nullable();
            $table->string('foto_1')->nullable();
            $table->text('text_1_b')->nullable();
            $table->text('text_2_a')->nullable();
            $table->string('foto_2')->nullable();
            $table->text('text_2_b')->nullable();
            $table->text('text_3_a')->nullable();
            $table->string('foto_3')->nullable();
            $table->text('text_3_b')->nullable();
            $table->text('text_4_a')->nullable();
            $table->string('foto_4')->nullable();
            $table->text('text_4_b')->nullable();
            $table->text('text_5_a')->nullable();
            $table->string('foto_5')->nullable();
            $table->text('text_5_b')->nullable();
            $table->text('bottom_text')->nullable();
            $table->string('location_n')->nullable();
            $table->string('location_e')->nullable();
            $table->boolean('active')->nullable();
            $table->string('date')->nullable();
            $table->string('stuff')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
