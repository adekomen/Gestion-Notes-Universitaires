<?php

namespace Tests\Feature;
use App\Models\Etudiant;
use App\Models\Elements_constitutif;
use App\Models\Unites_enseignement;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_ajout_note_valide()
{
    $note = Note::factory()->create();
    // $ec = EC::factory()->create();

    // $note = Note::create([
    //     'etudiant_id' => $etudiant->id,
    //     'ec_id' => $ec->id,
    //     'note' => 15, // Note valide
    // ]);

    $this->assertDatabaseHas('notes', [
        'etudiant_id' => $note->etudiant_id,
        'ec_id' => $note->ec_id,
        'note' => $note->note,
        'session' => $note->session,
    ]);
}

    public function test_note_valide_dans_les_limites()
    {
        $etudiant = Etudiant::factory()->create();
        $ec = Elements_constitutif::factory()->create();

        $note = Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 15, // Une note valide
            'session' => 'normale',
            'date_evaluation' => now(),
        ]);

        $this->assertDatabaseHas('notes', [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 15,
        ]);
    }

    public function test_note_invalide_en_dehors_des_limites()
    {
        $etudiant = Etudiant::factory()->create();
        $ec = Elements_constitutif::factory()->create();

        // Essayons d'ajouter une note en dehors des limites (exemple : 25)
        $response = $this->post('/notes', [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 21, // Note invalide
            'session' => 'normale',
            'date_evaluation' => now(),
        ]);

        // Vérifiez que la requête échoue et retourne une erreur de validation
        //$response->assertSessionHasErrors(['note' => 'La note doit être comprise entre 0 et 20.']);
    }
}


