<div class="container">

    <form action="{{ route('etudiants.destroy', $hotel->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
        <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
