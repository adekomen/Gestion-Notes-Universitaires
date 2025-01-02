
                    <h3 class="text-center mb-4">Modifier un étudiant</h3>
                    <form action="{{ route('etudiants.update', $etudiant->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $etudiant->nom }}" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $etudiant->prenom }}" required>
                        </div>
                        <div class="form-group">
                            <label for="niveau">Niveau</label>
                            <select class="form-control" id="niveau" name="niveau" required>
                                <option value="L1" >L1</option>
                                <option value="L2" >L2</option>
                                <option value="L3" >L3</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Update</button>
                        <button type="button" class="btn btn-secondary btn-block mt-2" onclick="window.location.href='{{ route('etudiants.index') }}'">Annuler</button>
                    </form>
