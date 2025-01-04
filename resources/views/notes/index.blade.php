
<div class="container">
    <h1>Liste des notes</h1>
    <a href="{{ route('notes.create') }}">Ajouter une note</a>
    <a class="btn btn-sm btn-success" href="{{ route('etudiants.create') }}">Ajouter un étudiant</a>

    <table class="table">
        <thead>
            <tr>
                <th>Étudiant</th>
                <th>ec_id</th>
                <th>Note</th>
                <th>Session</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notes as $note)
            <tr>
                <td>{{ $note->etudiant?->nom ?? 'Non défini' }}</td>
                <td>{{ $note->elementConstitutif?->nom ?? 'Non défini' }}</td>
                <td>{{ $note->note }}</td>
                <td>{{ $note->session }}</td>
                <td>{{ $note->date_evaluation }}</td>
                <td>
                    <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="{{ route('notes.show', $note->id) }}" class="btn btn-sm btn-info">Afficher</a>
                    <form action="{{ route('notes.destroy', $note->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette note ?')">Supprimer</button>
               </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

