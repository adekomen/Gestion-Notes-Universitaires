


<div class="container">
    <h1>Liste des notes</h1>
    <a href="{{ route('notes.create') }}">Ajouter une note</a>
    <a class="btn btn-sm btn-success" href="{{ route('etudiants.create') }}">Ajouter un étudiant</a>

    <table class="table">
        <thead>
            <tr>
                <th>Étudiant</th>
                <th>Matière</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
            <tr>
                <td>{{ $note->etudiant->nom }}</td>
                <td>{{ $note->matière }}</td>
                <td>{{ $note->note }}</td>
                <td>
                    <a href="{{ route('notes.edit', $note->id) }}">Modifier</a>
                    <a href="{{ route('notes.destroy', $note->id) }}">Supprimer</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

