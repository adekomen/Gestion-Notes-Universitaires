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
}
