<body>
    <div class="form">
        <h1 class="a">WELCOME HERE!!!</h1 >
        <div class="form-container">
            <div class="form-box">
                <h1 class="text-center mb-4">Ajouter un étudiant</h1>
                <form action="{{ route('etudiants.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control form-control-sm" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Prenom</label>
                        <input type="text" class="form-control form-control-sm" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Niveau</label>
                        <input type="text" class="form-control form-control-sm" id="niveau" name="niveau" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
                </form>
            </div>
        </div>
    </div>

    </body>
