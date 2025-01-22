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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('user_name')->nullable();
            $table->string('id_user')->nullable();
            $table->string('id_post')->nullable();
            $table->string('date')->nullable();
            $table->text('name_post')->nullable();
            $table->text('text_post')->nullable();
            $table->string('url_foto')->nullable();
            $table->string('step')->nullable();
            $table->string('stuff')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
