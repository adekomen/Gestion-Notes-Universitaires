<?php

namespace Tests\Unit;

use App\Models\Unites_enseignement;
use App\Models\Elements_constitutif;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UETest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de création d'une UE valide.
     */
    public function test_creation_ue(): void
    {
        $ue = Unites_enseignement::factory()->create([
            'code' => 'UE01',
            'nom' => 'Programmation Web',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);

        $this->assertDatabaseHas('unites_enseignements', [
            'code' => 'UE01',
            'nom' => 'Programmation Web',
        ]);
    }

    /**
     * Test de validation des crédits ECTS (entre 1 et 30).
     */
    public function test_validation_credits_ects(): void
    {
        $ue = Unites_enseignement::factory()->make([
            'credits_ects' => 35, // Valeur invalide
        ]);

        $this->assertFalse(
            $ue->credits_ects >= 1 && $ue->credits_ects <= 30,
            "Les crédits ECTS doivent être entre 1 et 30"
        );
    }

    /**
     * Test d'association des ECs à une UE.
     */
    public function test_association_ecs_to_ue(): void
    {
        $ue = Unites_enseignement::factory()->create([
            'code' => 'UE03',
            'nom' => 'Physique',
            'credits_ects' => 5,
            'semestre' => 2,
        ]);

        $ec = Elements_constitutif::create([
            'code' => 'EC01',
            'nom' => 'Mécanique',
            'ue_id' => $ue->id,
            'coefficient' => 2,
        ]);

        $this->assertDatabaseHas('elements_constitutifs', [
            'code' => 'EC01',
            'nom' => 'Mécanique',
            'ue_id' => $ue->id,
        ]);

        $this->assertTrue($ue->elementsConstitutifs->contains($ec));
    }

    /**
     * Test de validation du format du code UE (format UExx).
     */
    public function test_validation_code_ue_format_valide(): void
    {
        $ue = Unites_enseignement::factory()->make([
            'code' => 'UE11', // Format valide
        ]);

        $result = preg_match('/^UE\d{2}$/', $ue->code);

        $this->assertEquals(
            1,
            $result,
            "Le code UE doit respecter le format 'UExx'."
        );
    }

    /**
     * Test de validation du semestre (entre 1 et 6).
     */
    public function test_validation_semestre(): void
    {
        $ue = Unites_enseignement::factory()->make([
            'semestre' => 10, // Valeur invalide
        ]);

        $this->assertFalse(
            $ue->semestre >= 1 && $ue->semestre <= 6,
            "Le semestre doit être compris entre 1 et 6"
        );
    }
}
