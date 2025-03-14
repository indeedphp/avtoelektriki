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
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_name')->nullable();
            $table->string('telegram')->nullable();// добавить уникальность на telegram колонку ->unique();
            $table->integer('activ')->nullable();
            $table->string('token')->nullable();
            $table->string('stuff')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_name');
            $table->dropColumn('activ');
            $table->dropColumn('token');
            $table->dropColumn('stuff');
            $table->dropColumn('telegram');
        });
    }
};


// добавить местоположение (город)