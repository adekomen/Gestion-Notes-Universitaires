<body>

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Gestion des <b>Etudiants</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a class="btn btn-sm btn-success" href="{{ route('notes.create') }}">Ajouter une note</a>
                            <a class="btn btn-sm btn-success" href="{{ route('etudiants.create') }}">Ajouter un étudiant</a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etudiants as $etudiant)
                        <tr>
                        <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox{{ $etudiant->id }}">
                                    <label for="checkbox{{ $etudiant->id }}"></label>
                                </span>
                            </td>
                            <td>{{ $etudiant->nom}}</td>
                            <td>{{ $etudiant->prenom}}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="me-2">
                                        <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>
                                    <div class="me-2">
                                        <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-warning">
                                        <i class="bi bi-eye-fill"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('hotels.destroy', $hotel->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
