<?php

namespace App\Http\Controllers;

use App\Models\Unites_enseignement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UnitesEnseignementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('unites_enseignement.index', [
            'ues' => Unites_enseignement::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('unites_enseignement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $messages = [
        'code.regex' => 'Le code doit être au format UE suivi de deux chiffres (ex. UE01).',
        'code.unique' => 'Ce code est déjà utilisé pour une autre unité d\'enseignement.',
        ];

        $validated = $request->validate([
            'code' => 'required|string|regex:/^UE\d{2}$/|unique:unites_enseignements,code',
            'nom' => 'required|string',
            'credits_ects' => 'required|integer|min:1|max:30',
            'semestre' => 'required|integer|min:1|max:6',
        ],$messages);

        Unites_Enseignement::create($validated);

        return redirect(route('unites_enseignement.index'))->with('success', 'Unité d\'enseignement créée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unites_Enseignement $unites_enseignement): View
    {
        return view('unites_enseignement.edit', [
            'ue' => $unites_enseignement,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unites_Enseignement $unites_enseignement): RedirectResponse
    {
        $messages = [
        'code.regex' => 'Le code doit être au format UE suivi de deux chiffres (ex. UE01).',
        'code.unique' => 'Ce code est déjà utilisé pour une autre unité d\'enseignement.',
        ];

        $validated = $request->validate([
            'code' => 'required|string|regex:/^UE\d{2}$/|unique:unites_enseignements,code,' . $unites_enseignement->id,
            'nom' => 'required|string',
            'credits_ects' => 'required|integer|min:1|max:30',
            'semestre' => 'required|integer|min:1|max:6',
        ],$messages);

        $unites_enseignement->update($validated);

        return redirect(route('unites_enseignement.index'))->with('success', 'Unité d\'enseignement mise à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unites_Enseignement $unites_enseignement): RedirectResponse
    {
        $unites_enseignement->delete();

        return redirect(route('unites_enseignement.index'))->with('success', 'Unité d\'enseignement supprimée avec succès.');
    }
}
