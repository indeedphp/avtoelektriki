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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->text('complaint');
            $table->integer('id_user_complaint')->nullable();
            $table->integer('id_user_untrue')->nullable();
            $table->integer('id_post')->nullable();
            $table->integer('essence')->nullable();
            $table->integer('id_pcr')->nullable();
            $table->integer('viewed')->nullable();
            $table->string('stuff')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
