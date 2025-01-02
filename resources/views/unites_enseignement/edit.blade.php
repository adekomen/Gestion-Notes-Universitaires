<x-app-layout>
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Modifier une Unité d'Enseignement</h2>

        <form action="{{ route('unites_enseignement.update', $ue->id) }}" method="POST">
            @csrf
            @method('patch')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">Code UE</label>
                    <input type="text" name="code" id="code" value="{{ $ue->code }}" 
                        placeholder="Ex: UE01"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @error('code')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="nom" id="nom" value="{{ $ue->nom }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="credits_ects" class="block text-sm font-medium text-gray-700">Crédits ECTS</label>
                    <input type="number" name="credits_ects" id="credits_ects" value="{{ $ue->credits_ects }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="semestre" class="block text-sm font-medium text-gray-700">Semestre</label>
                    <input type="number" name="semestre" id="semestre" value="{{ $ue->semestre }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </div>
            <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Modifier</button>
        </form>
    </div>
</x-app-layout>
