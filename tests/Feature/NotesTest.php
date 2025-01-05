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


        //$response->assertSessionHasErrors(['note' => 'La note doit être comprise entre 0 et 20.']);

    //     public function calculer_Moyenne_ue($etudiant, $ue)
    // {
    //     // Récupérez les ECs associés à l'UE
    //     $ecs = $ue->elements_constitutifs;

    //     // Calculez la moyenne des notes de l'étudiant pour cette UE
    //     $totalNotes = 0;
    //     $count = 0;

    //     foreach ($ecs as $ec) {
    //         $note = Note::where('etudiant_id', $etudiant->id)
    //                     ->where('ec_id', $ec->id)
    //                     ->first();

    //         if ($note) {
    //             $totalNotes += $note->note;
    //             $count++;
    //         }
    //     }

    //     // Calcul de la moyenne
    //     if ($count > 0) {
    //         return $totalNotes / $count;
    //     }

    //     return 0;
    // }
    // }

}
// public function test_calculer_moyenne_ue()
//     {
//         // Créer un étudiant
//         $etudiant = Etudiant::factory()->create();

//         // Créer une UE
//     //    $ue = Unites_enseignement::factory()->create();
//     $ue = Unites_enseignement::create([
//         'code' => 'UE01',
//         'nom' => 'Unité d\'Enseignement 1',
//         'credits_ects' => 6,
//         'semestre' => 1,
//     ]);
//         $ec = Elements_constitutif::create([
//             'code' => 'EC05',
//             'nom' => 'Element Constitutif 1',
//             'coefficient' => 2,
//         ]);
//         // Créer des notes pour cet étudiant dans l'UE
//         $note1 = Note::create([
//             'etudiant_id' => $etudiant->id,
//             'ue_id' => $ue->id,
//             'ec_id' => $ec->id,  // Ajoute l'ID du EC si nécessaire
//             'note' => 12,
//             'coefficient' => 2,
//         ]);
//         $note2 = Note::create([
//             'etudiant_id' => $etudiant->id,
//             'ue_id' => $ue->id,
//             'ec_id' => $ec->id,  // Ajoute l'ID du EC si nécessaire
//             'note' => 16,
//             'coefficient' => 3,
//         ]);

//         // Appeler la méthode showMoyenne pour récupérer les notes et calculer la moyenne
//         $response = $this->get(route('notes.show', [
//             'etudiantId' => $etudiant->id,
//             'ueId' => $ue->id,
//         ]));

//         // Vérifier que la réponse est correcte (status OK)
//         $response->assertStatus(200);

//         // Vérifier que la vue contient les données nécessaires
//         $response->assertViewHas('notes', [$note1, $note2]); // Vérifier que les notes sont passées à la vue
//         $response->assertViewHas('moyenne'); // Vérifier que la moyenne est passée à la vue
//         $response->assertViewHas('is_validated'); // Vérifier que la validation est passée à la vue

//         // Vérifier que la moyenne calculée est correcte
//         $moyenneAttendue = (12 * 2 + 16 * 3) / (2 + 3); // Moyenne pondérée : (12*2 + 16*3) / (2+3)
//         $response->assertSee(round($moyenneAttendue, 2)); // Vérifier que la moyenne attendue est affichée
//     }



public function test_gestion_sessions_normale_rattrapage()
{
    // Créez un étudiant et une UE
    $etudiant = Etudiant::factory()->create();
    $ue = Unites_enseignement::factory()->create();

    // Créez un EC associé à l'UE
    $ec = Elements_constitutif::factory()->create(['ue_id' => $ue->id]);

    // Ajoutez une note pour la session normale
    Note::create([
        'etudiant_id' => $etudiant->id,
        'ec_id' => $ec->id,
        'note' => 8, // Note inférieure à la moyenne
        'session' => 'normale',
        'date_evaluation' => now(),
    ]);

    // Ajoutez une note pour la session de rattrapage
    Note::create([
        'etudiant_id' => $etudiant->id,
        'ec_id' => $ec->id,
        'note' => 12, // Note supérieure à la moyenne
        'session' => 'rattrapage',
        'date_evaluation' => now(),
    ]);

    // Calculez la meilleure note pour cet EC
    $meilleureNote = $this->obtenirMeilleureNote($etudiant, $ec);

    // Vérifiez que la meilleure note est celle de la session de rattrapage (12)
    $this->assertEquals(12, $meilleureNote);
}

/**
 * Fonction pour obtenir la meilleure note d'un étudiant pour un EC.
 */
private function test_obtenir_Meilleure_Note($etudiant, $ec)
{
    // Récupérez les notes de l'étudiant pour cet EC
    $notes = Note::where('etudiant_id', $etudiant->id)
                 ->where('ec_id', $ec->id)
                 ->get();

    // Retournez la meilleure note
    return $notes->max('note');
}








}
