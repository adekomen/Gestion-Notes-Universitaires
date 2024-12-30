<body>
    <div class="container-xl">
        <div class="card">
            <h2 style="text-align: center; padding-top: 10px;">Détails de nte d'un étudiant</h2>
            <div class="card-body">
                <div>
                    <p class="label">Nom </p>
                    <p class="card-text">{{ $etudiant->nom }}</p>
                </div>
                <div>
                    <p class="label">Prenom </p>
                    <p class="card-text">{{ $etudiant->prenm }}</p>
                </div>
                <div>
                    <p class="label">Niveau </p>
                    <p class="card-text">{{ $etudiant->niveau }}</p>
                </div>
                <a href="{{ route('notes.index') }}" class="btn btn-secondary">Retour</a>
                <a href="{{ route('notes.edit', $notes->id) }}" class="btn btn-primary">Update</a>

                <form action="{{ route('notes.destroy', $notes->id) }}" method="post" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</body>
