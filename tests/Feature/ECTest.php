<?php

namespace Tests\Feature;

use App\Models\Elements_constitutif;
use App\Models\Unites_enseignement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ECTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_creation_ec_valide()
    {
        $ec = Elements_constitutif::factory()->create([
            'code' => 'EC101',
            'nom' => 'Introduction à la programmation',
            'coefficient' => 3,
            'ue_id' => 1
        ]);

        $this->assertDatabaseHas('elements_constitutifs', [
            'code' => 'EC101',
            'nom' => 'Introduction à la programmation'
        ]);
    }

    /**
     * Test 2 : Vérification du rattachement à une UE.
     */
    public function test_rattachement_ec_ue()
    {
        $ue = Unites_enseignement::factory()->create();
        $ec = Elements_constitutif::factory()->create(['ue_id' => $ue->id]);

        $this->assertEquals($ue->id, $ec->ue_id);
    }

    /**
     * Test 3 : Modification d'un EC.
     */
    public function test_modification_ec()
    {
        $ec = Elements_constitutif::factory()->create(['nom' => 'Programmation']);
        $ec->update(['nom' => 'Programmation avancée']);

        $this->assertDatabaseHas('elements_constitutifs', [
            'nom' => 'Programmation avancée'
        ]);
    }

    /**
     * Test 4 : Validation du coefficient (entre 1 et 5).
     */
    public function test_validation_coefficient_ec()
    {
        $ec = Elements_constitutif::factory()->make(['coefficient' => 6]);
        $this->assertFalse($ec->save(), "Un coefficient supérieur à 5 ne doit pas être accepté.");

        $ec = Elements_constitutif::factory()->make(['coefficient' => 3]);
        $this->assertTrue($ec->save(), "Un coefficient entre 1 et 5 doit être accepté.");
    }

    /**
     * Test 5 : Suppression d'un EC.
     */
    public function test_suppression_ec()
    {
        $ec = Elements_constitutif::factory()->create();
        $ec->delete();

        $this->assertSoftDeleted($ec);
    }
}
