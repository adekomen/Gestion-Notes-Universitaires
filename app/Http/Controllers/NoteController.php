<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Elements_constitutif;
use App\Models\Etudiant;
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
    public function create(): View
    {
        $etudiants=Etudiant::all();
        $ecs = Elements_constitutif::all();
        return view ('notes.create', compact('etudiants','ecs'));
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
           //dd($validatedData);
           Note::create($validatedData);
           return redirect()->route('notes.index');
        }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $note = Note::with('etudiant')->findOrFail($id);
        return view('notes.show' ,compact('note'));;
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
      //  $note=Note::find($id);
        $note->delete();
        return redirect()->route('notes.index');
    }

//     public function calculerMoyenneUE($notes)
// {

//     $sommeNotesPonderees = 0;
//     $sommeCoefficients = 0;

//     foreach ($notes as $note) {
//         $sommeNotesPonderees += $note['note'] * $note['coefficient'];
//         $sommeCoefficients += $note['coefficient'];
//     }

//     if ($sommeCoefficients == 0) {
//         return null;
//     }

//     $moyenne = $sommeNotesPonderees / $sommeCoefficients;

//     return round($moyenne, 2);
// }




// public function showMoyenne($etudiantId, $ueId)
//     {
//     $moyenne = $this->calculerMoyenne($etudiantId, $ueId);

//     $isValidated = $moyenne >= 10;

//     return view('notes.show', [
//         'moyenne' => $moyenne,
//         'is_validated' => $isValidated,
//     ]);
//     }

 }
