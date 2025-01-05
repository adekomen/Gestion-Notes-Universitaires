<x-app-layout>
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Ajouter un Élément Constitutif</h2>

    <form action="{{ route('elements_constitutifs.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                <input type="text" name="code" id="code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label for="coefficient" class="block text-sm font-medium text-gray-700">Coefficient</label>
                <input type="number" name="coefficient" id="coefficient" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div>
                <label for="ue_id" class="block text-sm font-medium text-gray-700">UE Associée</label>
                <select name="ue_id" id="ue_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @foreach($uniteEnseignement as $ue)
                        <option value="{{ $ue->id }}">{{ $ue->code }} - {{ $ue->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Enregistrer</button>
    </form>
</div>
</x-app-layout>