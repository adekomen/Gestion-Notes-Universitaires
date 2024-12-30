<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="form-box">
                    <h3 class="text-center mb-4">Update Hotel</h3>
                    <form action="{{ route('etudiants.update', $hotel->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $etudiant->nom }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Prenom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $etudiant->prenom }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Niveau</label>
                            <input type="text" class="form-control" id="niveau" name="niveau" value="{{ $etudiant->niveau }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Update</button>
                        <button type="button" class="btn btn-secondary btn-block mt-2" onclick="window.location.href='{{ route('etudiants.index') }}'">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
