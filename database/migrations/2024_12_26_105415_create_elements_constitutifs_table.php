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
        Schema::create('elements_constitutifs', function (Blueprint $table) {
            $table->id();
            $table->string('code');//->unique();
            $table->string('nom');
            $table->unsignedTinyInteger('coefficient')->checkBetween(1, 5);
            $table->foreignId('ue_id')->constrained('unites_enseignements')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elements_constitutifs');
    }
};
