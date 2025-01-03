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
        $notes=Note::all();
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
    public function store(Request $request): View
    {
        //dd($request->all());
        $validatedData = $request->validate([

            'etudiant_id' => 'required|exists:etudiants,id',
             'ec_id' => 'required|exists:elements_constitutifs,id',
             'note'=> 'required|numeric|min:0|max:20',
             'session' =>'required|string|max:3',
             'date_evaluation'=>'required|decimal',
           ]);
          //   dd($validated);
           Note::create($validatedData);
           return redirect()->route('notes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
     //   $note=Note::find($id);
        return view('notes.show' ,compact('note'));;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note): View
    {
        //$note=Note::find($id);
        return view('notes.edit' ,compact('note'));;
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
             'session' =>'required|string|max:3',
             'date_evaluation'=>'required|decimal',
           ]);
          //   dd($validated_request);
           $note->update($validated);
           $note=Note::find($id);
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
}
