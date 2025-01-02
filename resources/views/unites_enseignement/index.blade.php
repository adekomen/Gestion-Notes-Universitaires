<x-app-layout>
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Liste des Unités d'Enseignement</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('unites_enseignement.create') }}" class="mb-4 inline-block px-4 py-2 bg-green-600 text-white rounded">Ajouter une UE</a>

    <table class="w-full text-left table-auto border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Code UE</th>
                <th class="border px-4 py-2">Nom</th>
                <th class="border px-4 py-2">ECTS</th>
                <th class="border px-4 py-2">Semestre</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ues as $ue)
                <tr>
                    <td class="border px-4 py-2">{{ $ue->code }}</td>
                    <td class="border px-4 py-2">{{ $ue->nom }}</td>
                    <td class="border px-4 py-2">{{ $ue->credits_ects }}</td>
                    <td class="border px-4 py-2">{{ $ue->semestre }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('unites_enseignement.edit', $ue->id) }}" class="text-blue-600 hover:underline">Modifier</a>

                        <form action="{{ route('unites_enseignement.destroy', $ue->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Voulez-vous vraiment supprimer cette UE ?')">Supprimer</button>
                        </form>

                        <!-- <form method="POST" action="{{ route('unites_enseignement.destroy', $ue->id) }}">
                            @csrf
                            @method('delete')
                            <x-dropdown-link :href="route('unites_enseignement.destroy', $ue->id)" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Delete') }}
                            </x-dropdown-link> -->
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
