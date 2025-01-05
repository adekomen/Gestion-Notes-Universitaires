
<body>
    <div class="container h-100 mt-5">
        <div class="col-10 col-md-8 col-lg-6">
          <h2 class="text-center mb-4">Modifier une note</h2>
          <form action="{{ route('notes.update', $note->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
              <label for="etudiant_id">Étudiant</label>
              <select id="etudiant_id" name="etudiant_id" class="form-control" required>
                @foreach($etudiants as $etudiant)
                  <option value="{{ $etudiant->id }}" {{ $etudiant->id == $note->etudiant_id ? 'selected' : '' }}>
                    {{ $etudiant->nom }} {{ $etudiant->prenom }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="ec_id">Élément Constitutif (EC)</label>
              <select id="ec_id" name="ec_id" class="form-control" required>
                @foreach($ecs as $ec)
                  <option value="{{ $ec->id }}" {{ $ec->id == $note->ec_id ? 'selected' : '' }}>
                    {{ $ec->nom }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="note">Note</label>
              <input type="number" id="note" name="note" class="form-control" value="{{ $note->note }}" required>
            </div>
            <div class="form-group">
                <label for="note">Session</label>
                <input type="text" id="note" name="session" class="form-control" value="{{ $note->session }}" required>
              </div>
              <div class="form-group">
                <label for="note">Date de l'évaluation</label>
                <input type="date" id="note" name="date_evaluation" class="form-control" value="{{ $note->date_evaluation }}" required>
              </div>

            <button type="submit" class="btn btn-primary btn-block mt-3">Mettre à jour</button>
            <button type="button" class="btn btn-secondary ms-2" onclick="window.location.href='{{ route('notes.index') }}'">Annuler</button>
          </form>
        </div>
    </div>
</body>
