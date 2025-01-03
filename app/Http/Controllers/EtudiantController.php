<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $etudiants=Etudiant::all();
        return view('etudiants.index', compact('etudiants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('etudiants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'numero_etudiant' => 'required|string|unique:etudiants,numero_etudiant',
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'niveau' => 'required|string|in:L1,L2,L3',
        ]);
      //  dd($validatedData);
        Etudiant::create($validatedData);
        return redirect()->route('etudiants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
     //   $etudiant=Etudiant::find($id);
        return view('etudiants.show' , compact('etudiant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
    //    $etudiant=Etudiant::find($id);
        return view('etudiants.edit' , compact('etudiant'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $validatedData = $request->validate([
            'numero_etudiant' => 'required|string|unique:etudiants,numero_etudiant',
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'niveau' => 'required|string|in:L1,L2,L3',
        ]);
        $etudiant = Etudiant::find($etudiant);
        $etudiant->update($validatedData);
        return redirect()->route('etudiants.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
       // $etudiant=Etudiant::find($id);
        $etudiant->delete();
        return redirect()->route('etudiants.index');

    }
}
