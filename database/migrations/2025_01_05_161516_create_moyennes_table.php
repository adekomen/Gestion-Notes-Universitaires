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
        Schema::create('moyennes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade'); // Lien avec la table des étudiants
            $table->foreignId('ue_id')->constrained('unites_enseignements')->onDelete('cascade'); // Lien avec la table des UEs
            $table->float('moyenne', 5, 2); // Stocker la moyenne (max 999.99 pour éviter les grands nombres inutiles)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moyennes');
    }
};
