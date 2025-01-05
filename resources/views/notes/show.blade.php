@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<body>
    <div class="container-xl">
        <div class="card">
            <h2 style="text-align: center; padding-top: 10px;">Détails de la note d'un étudiant</h2>
            <div class="card-body">
                <!-- Informations sur l'étudiant -->
                <div>
                    <p class="label">Étudiant : <span class="card-text">{{ $note->etudiant_id }}</span></p>
                </div>

                <!-- Note -->
                <div>
                    <p class="label">Note : <span class="card-text">{{ $note->note }}</span></p>
                </div>

                <!-- Moyenne de l'UE -->
                <div>
                    <p class="label">
                        Moyenne de l'UE :
                        <span class="card-text">
                            @if (isset($moyenne))
                                {{ number_format($moyenne, 2) }}
                            @else
                                Aucune moyenne disponible
                            @endif
                        </span>
                    </p>
                </div>

                <!-- Boutons d'action -->
                <a href="{{ route('notes.showMoyenne', ['etudiantId' => $note->etudiant_id, 'ueId' => $ue->id]) }}" class="btn btn-info">
                    Voir Moyenne
                </a>
                <a href="{{ route('notes.index') }}" class="btn btn-secondary">Retour</a>
                <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-primary">Modifier</a>

                <form action="{{ route('notes.destroy', $note->id) }}" method="post" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Résultat de l'UE -->
    <div class="container mx-auto p-6 bg-white shadow-md rounded-md mt-4">
        <h1 class="text-xl font-bold mb-4">Résultat de l'UE</h1>
        <p>Moyenne : {{ isset($moyenne) ? $moyenne : 'Non calculée' }}</p>
        <p>
            Statut :
            @if (isset($is_validated) && $is_validated)
                <span class="text-green-500">Validée</span>
            @else
                <span class="text-red-500">Non Validée</span>
            @endif
        </p>
    </div>
</body>
