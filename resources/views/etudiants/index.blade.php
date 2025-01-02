<body>
    <div class="container mx-auto p-6">
        <div class="overflow-x-auto shadow-lg rounded-lg">
            <div class="bg-white p-4 rounded-t-lg flex justify-between items-center">
                <h2 class="text-xl font-semibold">Création des <b>Etudiants</b></h2>
                <div>
                    <a class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400" href="{{ route('notes.create') }}">Ajouter une note</a>
                    <a class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400" href="{{ route('etudiants.create') }}">Ajouter un étudiant</a>
                </div>
            </div>

            <table class="min-w-full bg-white border border-gray-300 rounded-lg mt-4">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="px-6 py-3">
                        </th>
                        <th class="px-6 py-3">Nom</th>
                        <th class="px-6 py-3">Prénom</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($etudiants as $etudiant)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3">
                        </td>
                        <td class="px-6 py-3">{{ $etudiant->nom }}</td>
                        <td class="px-6 py-3">{{ $etudiant->prenom }}</td>
                        <td class="px-6 py-3">
                            <div class="flex space-x-4">

                                <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                    <i class="bi bi-pencil-square"></i> Modifier
                                </a>

                                <a href="{{ route('etudiants.show', $etudiant->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    <i class="bi bi-eye-fill"></i> Afficher
                                </a>

                                <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="post" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
