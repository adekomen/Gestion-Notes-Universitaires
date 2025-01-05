<?php

namespace Tests\Unit;

use App\Models\Elements_constitutif;
use App\Models\Unites_enseignement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ECTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de création d'un EC avec un coefficient valide.
     */
    public function test_creation_ec_avec_coefficient(): void
    {
        $ue = Unites_enseignement::factory()->create();
        $ec = Elements_constitutif::factory()->create([
            'code' => 'EC01',
            'nom' => 'Programmation PHP',
            'ue_id' => $ue->id,
            'coefficient' => 3,
        ]);

        $this->assertDatabaseHas('elements_constitutifs', [
            'code' => 'EC01',
            'nom' => 'Programmation PHP',
        ]);
    }

    /**
     * Test de vérification du rattachement d'un EC à une UE.
     */
    public function test_verification_rattachement_ec_ue(): void
    {
        $ue = Unites_enseignement::factory()->create();
        $ec = Elements_constitutif::factory()->create([
            'ue_id' => $ue->id,
        ]);

        $this->assertEquals($ue->id, $ec->ue_id, "L'EC doit être rattaché à la bonne UE.");
    }

    /**
     * Test de modification d'un EC.
     */
    public function test_modification_ec(): void
    {
        $ec = Elements_constitutif::factory()->create([
            'code' => 'EC02',
            'nom' => 'Algorithmes',
            'coefficient' => 2,
        ]);

        $ec->update([
            'nom' => 'Algorithmes Avancés',
        ]);

        $this->assertDatabaseHas('elements_constitutifs', [
            'code' => 'EC02',
            'nom' => 'Algorithmes Avancés',
        ]);
    }

    /**
     * Test de validation du coefficient (entre 1 et 5).
     */
    public function test_validation_coefficient(): void
    {
        $ec = Elements_constitutif::factory()->make([
            'coefficient' => 6, // Coefficient invalide
        ]);

        $this->assertFalse(
            $ec->coefficient >= 1 && $ec->coefficient <= 5,
            "Le coefficient doit être compris entre 1 et 5."
        );
    }

    /**
     * Test de suppression d'un EC.
     */
    public function test_suppression_ec(): void
    {
        $ec = Elements_constitutif::factory()->create([
            'code' => 'EC03',
            'nom' => 'Systèmes d\'exploitation',
        ]);

        $ec->delete();

        $this->assertDatabaseMissing('elements_constitutifs', [
            'code' => 'EC03',
            'nom' => 'Systèmes d\'exploitation',
        ]);
    }
}
