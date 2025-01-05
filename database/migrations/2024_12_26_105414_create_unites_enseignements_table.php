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
        Schema::create('unites_enseignements', function (Blueprint $table) {
            $table->id();
            $table->string('code',30)->unique();
            $table->string('nom');
            $table->unsignedTinyInteger('credits_ects')->check('credits_ects between 1 and 30');
            $table->unsignedTinyInteger('semestre')->comment('1 à 6');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unites_enseignements');
    }
};
