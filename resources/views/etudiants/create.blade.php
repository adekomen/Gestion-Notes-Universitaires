<form action="{{ route('etudiants.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="numero_etudiant">Numéro étudiant</label>
        <input type="text" class="form-control form-control-sm" id="numero_etudiant" name="numero_etudiant" required>
    </div>
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control form-control-sm" id="nom" name="nom" required>
    </div>
    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" class="form-control form-control-sm" id="prenom" name="prenom" required>
    </div>
    <div class="form-group">
        <label for="niveau">Niveau</label>
        <select type="text" class="form-control form-control-sm" id="niveau" name="niveau" required>
        <option value="L1" >L1</option>
        <option value="L2" >L2</option>
        <option value="L3" >L3</option>
    </select>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
