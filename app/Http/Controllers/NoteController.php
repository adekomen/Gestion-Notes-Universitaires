<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Elements_constitutif;
use App\Models\Etudiant;
use App\Models\Moyenne;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $notes = Note::with(['etudiant', 'elementConstitutif'])->get();
        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($ueId): View
    {
        $ue = Unites_enseignement::findOrFail($ueId);
        $etudiants=Etudiant::all();
        $ecs = Elements_constitutif::all();
        return view ('notes.create', compact('etudiants','ecs','ue'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([

            'etudiant_id' => 'required|exists:etudiants,id',
             'ec_id' => 'required|exists:elements_constitutifs,id',
             'note'=> 'required|numeric|min:0|max:20',
             'session' =>'required|string',
             'date_evaluation'=>'required|date',

           ]);
       //    $moyenneUE = $this->calculerMoyenneUE($validatedData['notes']);
           Note::create($validatedData);
           return redirect()->route('notes.index');
        }

    /**
     * Display the specified resource.
     */
    public function show($ueId)
    {
        // Récupérer l'UE et ses EC
        $ue = UE::findOrFail($ueId);
        $ecs = $ue->ecs;

        // Récupérer les notes pour chaque EC de cette UE
        $notes = [];
        foreach ($ecs as $ec) {
            // Supposons que vous avez une relation entre EC et Note
            $notes[$ec->id] = $ec->notes->pluck('note'); // Récupérer les notes de l'EC
        }

        // Calculer la moyenne de l'UE
        $totalNotes = 0;
        $totalCount = 0;

        foreach ($notes as $ecNotes) {
            $totalNotes += $ecNotes->sum();
            $totalCount += $ecNotes->count();
        }

        $moyenne = $totalCount > 0 ? $totalNotes / $totalCount : 0;

        return view('notes.show', compact('ue', 'ecs', 'notes', 'moyenne'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id): View
    {
        $etudiants = Etudiant::all();
        $ecs = Elements_constitutif::all();
        $note = Note::with('etudiant')->findOrFail($id);
        return view('notes.edit' ,compact('note','etudiants','ecs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note): RedirectResponse
    {
        $validated = $request->validate([

            'etudiant_id' => 'required|exists:etudiants,id',
             'ec_id' => 'required|exists:elements_constitutifs,id',
             'note'=> 'required|numeric|min:0|max:20',
            'session' =>'required|string',
            'date_evaluation'=>'required|date',
           ]);
          //   dd($validated_request);
           $note->update($validated);
          // $note=Note::find($id);
           return redirect()->route('notes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note): RedirectResponse
    {
        $note->delete();
        return redirect()->route('notes.index');
    }

    public function calculerEtSauvegarderMoyenne($etudiantId, $ueId, $notes)
    {
        $sommeNotesPonderees = 0;
        $sommeCoefficients = 0;

        foreach ($notes as $note) {
            $sommeNotesPonderees += $note->note * $note->coefficient;
            $sommeCoefficients += $note->coefficient;
        }

        if ($sommeCoefficients == 0) {
            return null; // Pas de coefficient, impossible de calculer la moyenne
        }

        $moyenne = round($sommeNotesPonderees / $sommeCoefficients, 2);

        // Sauvegarder ou mettre à jour la moyenne dans la table `moyennes`
        Moyenne::updateOrCreate(
            ['etudiant_id' => $etudiantId, 'ue_id' => $ueId],
            ['moyenne' => $moyenne]
        );

        return $moyenne;
    }

    public function showMoyenne($etudiantId, $ueId)
    {
        $moyenne = Moyenne::where('etudiant_id', $etudiantId)
            ->where('ue_id', $ueId)
            ->value('moyenne'); // Récupère uniquement la colonne 'moyenne'

        $isValidated = $moyenne >= 10;

        return view('notes.show', [
            'moyenne' => $moyenne,
            'is_validated' => $isValidated,
        ]);
    }


}
