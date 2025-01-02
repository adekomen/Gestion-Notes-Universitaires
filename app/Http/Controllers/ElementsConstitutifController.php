<?php

namespace App\Http\Controllers;

use App\Models\Elements_constitutif;
use App\Models\Unites_enseignement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ElementsConstitutifController extends Controller
{
    public function index(): View
    {
        return view('elements_constitutifs.index', [
            'ecs' => Elements_constitutif::with('uniteEnseignement')->get(),
        ]);
    }

    public function create(): View
    {
        return view('elements_constitutifs.create', [
            'uniteEnseignement' => Unites_enseignement::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:elements_constitutifs,code',
            'nom' => 'required|string',
            'coefficient' => 'required|integer|min:1|max:5',
            'ue_id' => 'required|exists:unites_enseignements,id',
        ]);

        Elements_Constitutif::create($validated);

        return redirect(route('elements_constitutifs.index'))->with('success', 'Élément constitutif créé avec succès.');
    }

    public function edit(Elements_Constitutif $elements_constitutif): View
    {
        $ues = Unites_Enseignement::all();
        return view('elements_constitutifs.edit', [
            'ec' => $elements_constitutif,
            'ues' => $ues,
        ]);
    }

    public function update(Request $request, Elements_Constitutif $elements_constitutif): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'string|unique:elements_constitutifs,code,' . $elements_constitutif->id,
            'nom' => 'string',
            'coefficient' => 'integer|min:1|max:5',
            'ue_id' => 'exists:unites_enseignements,id',
        ]);

        $elements_constitutif->update($validated);

        return redirect(route('elements_constitutifs.index'))->with('success', 'Élément constitutif mis à jour avec succès.');
    }

    public function destroy(Elements_Constitutif $elements_constitutif): RedirectResponse
    {
        $elements_constitutif->delete();

        return redirect(route('elements_constitutifs.index'))->with('success', 'Élément constitutif supprimé avec succès.');
    }
}
