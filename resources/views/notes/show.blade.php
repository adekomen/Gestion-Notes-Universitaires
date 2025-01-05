<body>
    <div class="container-xl">
        <div class="card">
            <h2 style="text-align: center; padding-top: 10px;">Détails de note d'un étudiant</h2>
            <div class="card-body">
                <div>
                    <p class="label">Étudiant : <span class="card-text">{{ $note->etudiant_id }}</span></p>
                </div>

                <div>
                    <p class="label">Note: <span class="card-text">{{ $note->note }} </span></p>
                </div>
                <a href="{{ route('notes.index') }}" class="btn btn-secondary">Retour</a>
                <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-primary">Update</a>

                <form action="{{ route('notes.destroy', $note->id) }}" method="post" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
    {{-- <div class="container mx-auto p-6 bg-white shadow-md rounded-md">
        <h1 class="text-xl font-bold mb-4">Résultat de l'UE</h1>
        <p>Moyenne : {{ $moyenne }}</p>
        <p>
            Statut :
            @if($is_validated)
                <span class="text-green-500">Validée</span>
            @else
                <span class="text-red-500">Non Validée</span>
            @endif
        </p>
    </div> --}}

</body>
