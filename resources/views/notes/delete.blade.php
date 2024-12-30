

    <div class="container">
        <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
            <a href="{{ route('notes.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
