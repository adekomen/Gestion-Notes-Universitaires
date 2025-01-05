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
public function test_calculer_moyenne_ue()
    {
        $etudiant = Etudiant::factory()->create();

        // Créer une UE
    //    $ue = Unites_enseignement::factory()->create();
    $ue = Unites_enseignement::create([
        'code' => 'UE09',
        'nom' => 'Unité d\'Enseignement 1',
        'credits_ects' => 6,
        'semestre' => 1,
    ]);
        $ec = Elements_constitutif::create([
            'code' => 'EC05',
            'nom' => 'Element Constitutif 1',
            'coefficient' => 2,
        ]);
        // Créer des notes pour cet étudiant dans l'UE
        $note1 = Note::create([
            'etudiant_id' => $etudiant->id,
            'ue_id' => $ue->id,
            'ec_id' => $ec->id,  // Ajoute l'ID du EC si nécessaire
            'note' => 12,
            'coefficient' => 2,
        ]);
        $note2 = Note::create([
            'etudiant_id' => $etudiant->id,
            'ue_id' => $ue->id,
            'ec_id' => $ec->id,  // Ajoute l'ID du EC si nécessaire
            'note' => 16,
            'coefficient' => 3,
        ]);

        // Appeler la méthode showMoyenne pour récupérer les notes et calculer la moyenne
        $response = $this->get(route('notes.show', [
            'etudiantId' => $etudiant->id,
            'ueId' => $ue->id,
        ]));

        // Vérifier que la réponse est correcte (status OK)
        $response->assertStatus(200);

        // Vérifier que la vue contient les données nécessaires
        $response->assertViewHas('notes', [$note1, $note2]); // Vérifier que les notes sont passées à la vue
        $response->assertViewHas('moyenne'); // Vérifier que la moyenne est passée à la vue
        $response->assertViewHas('is_validated'); // Vérifier que la validation est passée à la vue

        // Vérifier que la moyenne calculée est correcte
        $moyenneAttendue = (12 * 2 + 16 * 3) / (2 + 3); // Moyenne pondérée : (12*2 + 16*3) / (2+3)
        $response->assertSee(round($moyenneAttendue, 2)); // Vérifier que la moyenne attendue est affichée
    }



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
private function test_obtenir_Meilleure_Note($etudiant, $ec)
{
    // Récupérez les notes de l'étudiant pour cet EC
    $notes = Note::where('etudiant_id', $etudiant->id)
                 ->where('ec_id', $ec->id)
                 ->get();

    // Retournez la meilleure note
    return $notes->max('note');
}

public function test_validation_notes_manquantes()
{
     // Créez un étudiant, une UE, et deux ECs
     $etudiant = Etudiant::factory()->create();
     $ue = Unites_enseignement::factory()->create();
     $ec1 = Elements_constitutif::factory()->create(['ue_id' => $ue->id]);
     $ec2 = Elements_constitutif::factory()->create(['ue_id' => $ue->id]);

     // Ajoutez une note pour le premier EC
     Note::create([
         'etudiant_id' => $etudiant->id,
         'ec_id' => $ec1->id,
         'note' => 14,
         'session' => 'normale',
         'date_evaluation' => now(),
     ]);

     // Vérifiez la validation des notes manquantes
     $resultat = $this->gererNotesManquantes($etudiant, [$ec1, $ec2]);

     // Vérifiez que la note pour le deuxième EC est manquante
     $this->assertTrue($resultat['manque']);
     $this->assertEquals([$ec2->id], $resultat['details']);
    }
/**
 * Fonction pour vérifier les notes manquantes pour un étudiant dans une liste d'ECs.
 */
private function gererNotesManquantes($etudiant, $ecs)
{
    $notesManquantes = [];

    foreach ($ecs as $ec) {
        $note = Note::where('etudiant_id', $etudiant->id)
                    ->where('ec_id', $ec->id)
                    ->first();

        if (!$note) {
            $notesManquantes[] =   $ec->id;
        }
    }

    return [
        'manque' => count($notesManquantes) > 0,
        'details' => $notesManquantes,
    ];
}


public function test_validation_ue()
{
    // Créez un étudiant
    $etudiant = Etudiant::factory()->create();

    // Créez une UE
    $ue = Unites_enseignement::factory()->create();

    // Créez deux ECs associés à l'UE
    $ec5 = Elements_constitutif::factory()->create(['ue_id' => $ue->id, 'coefficient' => 2]);
    $ec6 = Elements_constitutif::factory()->create(['ue_id' => $ue->id, 'coefficient' => 3]);

    // Ajoutez des notes pour les ECs
    Note::create([
        'etudiant_id' => $etudiant->id,
        'ec_id' => $ec5->id,
        'note' => 15,
        'session' => 'normale',
        'date_evaluation' => now(),
    ]);

    Note::create([
        'etudiant_id' => $etudiant->id,
        'ec_id' => $ec6->id,
        'note' => 19,
        'session' => 'normale',
        'date_evaluation' => now(),
    ]);

    // Calculez la moyenne de l'UE
    $moyenneUE = $this->calculerMoyenneUE($etudiant, $ue);

    // Vérifiez que la moyenne de l'UE est calculée correctement
   // $this->assertEquals(9.2, $moyenneUE);

    // Vérifiez que l'UE est validée (si moyenne >= 10)
    $isValidee = $moyenneUE >= 10;
    $this->assertFalse($isValidee); // UE non validée car moyenne < 10

    // Ajoutez une nouvelle note pour compenser et valider l'UE
    // Note::create([
    //     'etudiant_id' => $etudiant->id,
    //     'ec_id' => $ec6->id,
    //     'note' => 18,
    //     'session' => 'rattrapage',
    //     'date_evaluation' => now(),
    // ]);

    // Recalculez la moyenne de l'UE
    $moyenneUE = $this->calculerMoyenneUE($etudiant, $ue);

    // Vérifiez que l'UE est maintenant validée
    $this->assertTrue($moyenneUE >= 10, "L'UE n'est pas validée alors qu'elle devrait l'être.");
}

/**
 * Calculer la moyenne pondérée d'une UE pour un étudiant.
 */
private function calculerMoyenneUE($etudiant, $ue)
{
    $ecs = Elements_constitutif::where('ue_id', $ue->id)->get();
    $totalCoef = 0;
    $sommeNotesPonderees = 0;

    foreach ($ecs as $ec) {
        $note = Note::where('etudiant_id', $etudiant->id)
                    ->where('ec_id', $ec->id)
                    ->orderBy('session', 'desc') // Prioriser la session de rattrapage si elle existe
                    ->first();

        if ($note) {
            $sommeNotesPonderees += $note->note * $ec->coef;
            $totalCoef += $ec->coef;
        }
    }

    return $totalCoef > 0 ? $sommeNotesPonderees / $totalCoef : 0;
}


public function test_compensation_entre_ues()
{
    // Créez un étudiant
    $etudiant = Etudiant::factory()->create();

    // Créez deux UEs dans le même semestre
    $ue1 = Unites_enseignement::factory()->create(['semestre' => 1, 'credits_ects' => 6]);
    $ue2 = Unites_enseignement::factory()->create(['semestre' => 1, 'credits_ects' => 4]);

    // Créez des ECs associés aux UEs
    $ec1_1 = Elements_constitutif::factory()->create(['ue_id' => $ue1->id, 'coefficient' => 1]);
    $ec1_2 = Elements_constitutif::factory()->create(['ue_id' => $ue1->id, 'coefficient' => 2]);
    $ec2_1 = Elements_constitutif::factory()->create(['ue_id' => $ue2->id, 'coefficient' => 1]);

    // Ajoutez des notes pour les ECs
    Note::create([
        'etudiant_id' => $etudiant->id,
        'ec_id' => $ec1_1->id,
        'note' => 9,
        'session' => 'normale',
        'date_evaluation' => now(),
    ]);

    Note::create([
        'etudiant_id' => $etudiant->id,
        'ec_id' => $ec1_2->id,
        'note' => 8,
        'session' => 'normale',
        'date_evaluation' => now(),
    ]);

    Note::create([
        'etudiant_id' => $etudiant->id,
        'ec_id' => $ec2_1->id,
        'note' => 12,
        'session' => 'normale',
        'date_evaluation' => now(),
    ]);

    // Calculez la moyenne des UEs
    $moyenneUE1 = $this->calculerMoyenneUE($etudiant, $ue1); // Moyenne attendue : 8.33
    $moyenneUE2 = $this->calculerMoyenneUE($etudiant, $ue2); // Moyenne attendue : 12

    // Vérifiez les moyennes
    $this->assertEquals(8.33, round($moyenneUE1, 2), "La moyenne de l'UE1 est incorrecte.");
    $this->assertEquals(12, round($moyenneUE2, 2), "La moyenne de l'UE2 est incorrecte.");

    // Calculez la moyenne pondérée du semestre
    $moyennePonderee = $this->calculerMoyennePondereeSemestre($etudiant, 1);

    // Vérifiez la moyenne pondérée
    $this->assertEquals(9.8, round($moyennePonderee, 1), "La moyenne pondérée du semestre est incorrecte.");

    // Vérifiez si le semestre est compensé
    $semestreValide = $this->verifierCompensationSemestre($etudiant, 1);

    $this->assertTrue($semestreValide, "Le semestre n'est pas validé alors qu'il devrait l'être.");
}



}
