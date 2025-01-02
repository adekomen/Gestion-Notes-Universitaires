<x-app-layout>
<div class="bg-white p-6 rounded shadow mx-60 mt-12">
    <h2 class="text-2xl font-bold mb-4">Ajouter une Unité d'Enseignement</h2>

    <form action="{{ route('unites_enseignement.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="code" class="block text-sm font-medium text-gray-700">Code UE</label>
            <input type="text" name="code" id="code" required
                placeholder="Ex: UE01"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('code')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="nom" id="nom" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label for="credits_ects" class="block text-sm font-medium text-gray-700">Crédits ECTS</label>
            <input type="number" name="credits_ects" id="credits_ects" min="0" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label for="semestre" class="block text-sm font-medium text-gray-700">Semestre</label>
            <select name="semestre" id="semestre" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="1">Semestre 1</option>
                <option value="2">Semestre 2</option>
                <option value="3">Semestre 3</option>
                <option value="4">Semestre 4</option>
                <option value="5">Semestre 5</option>
                <option value="6">Semestre 6</option>
            </select>
        </div>
        <div>
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Enregistrer
            </button>
        </div>
    </form>
</div>
</x-app-layout>
