<body>
    <div class="container-xl">
        <div class="card">
            <h2 style="text-align: center; padding-top: 10px;">Détails concernant un étudiant</h2>
            <div class="card-body">
                <div>
                    <p class="label">Nom: <span class="card-text">{{ $etudiant->nom }}</span></p>
                </div>
                <div>
                    <p class="label">Prenom : <span class="card-text">{{ $etudiant->prenom }}</span></p>
                </div>
                <div>
                    <p class="label">Niveau: <span class="card-text">{{ $etudiant->niveau }}</span></p>
                </div>
                <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">Retour</a>
                <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-primary">Update</a>

                <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="post" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</body>
