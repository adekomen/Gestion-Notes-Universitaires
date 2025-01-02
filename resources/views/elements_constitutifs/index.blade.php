<x-app-layout>
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Liste des éléments Constitutifs (EC)</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('elements_constitutifs.create') }}" class="mb-4 inline-block px-4 py-2 bg-green-600 text-white rounded">Ajouter un Élément Constitutif</a>

    <table class="w-full text-left table-auto border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Code</th>
                <th class="border px-4 py-2">Nom</th>
                <th class="border px-4 py-2">coefficient</th>
                <th class="border px-4 py-2">UE Associée</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ecs as $ec)
                <tr>
                    <td class="border px-4 py-2">{{ $ec->code }}</td>
                    <td class="border px-4 py-2">{{ $ec->nom }}</td>
                    <td class="border px-4 py-2">{{ $ec->coefficient }}</td>
                    <td class="border px-4 py-2">{{ $ec->uniteEnseignement->nom }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('elements_constitutifs.edit', $ec->id) }}" class="text-blue-600 hover:underline">Modifier</a>
                        <form action="{{ route('elements_constitutifs.destroy', $ec->id) }}" method="POST" class="inline" onsubmit="return confirm('Voulez-vous vraiment supprimer cet Élément Constitutif ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>