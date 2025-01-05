<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Unites_enseignement;
use App\Models\Elements_constitutif;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UETest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de création d'une UE valide.
     */
    public function test_creation_ue_valide()
    {
        $ue = Unites_enseignement::factory()->create([
            'code' => 'UE11',
            'nom' => 'Programmation Web',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);

        $this->assertDatabaseHas('unites_enseignements', [
            'code' => 'UE11',
            'nom' => 'Programmation Web',
        ]);
    }

    /**
     * Vérification des crédits ECTS (entre 1 et 30).
     */
    public function test_verification_credits_ects()
    {
        try {
            $ue = Unites_enseignement::factory()->make(['credits_ects' => 31]);
            $ue->save();
            $this->fail("Une UE avec des crédits supérieurs à 30 ne doit pas être validée.");
        } catch (\Exception $e) {
            $this->assertEquals("Les crédits ECTS doivent être compris entre 1 et 30.", $e->getMessage());
        }

        try {
            $ue = Unites_enseignement::factory()->make(['credits_ects' => 6]);
            $this->assertTrue($ue->save(), "Une UE avec des crédits entre 1 et 30 doit être validée.");
        } catch (\Exception $e) {
            $this->fail("Une exception inattendue a été levée : " . $e->getMessage());
        }
    }

    public function test_association_ecs_ue()
    {
        $ue = Unites_enseignement::factory()->create();
        $ecs = Elements_constitutif::factory()->count(3)->create(['ue_id' => $ue->id]);

        $this->assertCount(3, $ue->elementsConstitutifs, "L'UE doit contenir exactement 3 ECs associés.");
    }

    public function test_validation_code_ue()
    {
        try {
            $ue = Unites_enseignement::factory()->make(['code' => 'XX11']);
            $ue->save();
            $this->fail("Le code UE doit commencer par 'UE' suivi de deux chiffres.");
        } catch (\Exception $e) {
            $this->assertEquals("Le code UE doit commencer par 'UE' suivi de deux chiffres.", $e->getMessage());
        }

        try {
            $ue = Unites_enseignement::factory()->make(['code' => 'UE11']);
            $this->assertTrue($ue->save(), "Le code UE valide doit être accepté.");
        } catch (\Exception $e) {
            $this->fail("Une exception inattendue a été levée : " . $e->getMessage());
        }
    }

    /**
     * Vérification du semestre.
     */
    public function test_verification_semestre()
    {
        $ue = Unites_enseignement::factory()->make(['semestre' => 7]);
        $this->assertFalse($ue->save(), "Le semestre doit être entre 1 et 6.");

        $ue = Unites_enseignement::factory()->make(['semestre' => 1]);
        $this->assertTrue($ue->save(), "Un semestre valide entre (1 et 6) doit être accepté.");
    }
}
