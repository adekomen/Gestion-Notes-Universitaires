<body>
    <div class="container h-100 mt-5">
        <div class="col-10 col-md-8 col-lg-6">
          <h2 class="text-center mb-4">Update</h2>
          <form action="{{route ('notes.update', $note->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="{{$note->nom}}" required>
            <div class="form-group">
            <label for="nom">Prenom</label>
            <input type="text" id="prenom" name="prenom" value="{{$note->prix}}" required>
            <div class="form-group">
            <label for="nom">Niveau</label>
            <input type="text" id="niveau" name="niveau" value="{{$note->niveau}}" required>
            <div class="form-group">

            <button type="submit" class="btn btn-primary btn-block mt-3">Update</button>
            <button type="button" class="btn btn-secondary ms-2" onclick="window.location.href='{{ route('rooms.index') }}'">Cancel</button>

            </form>
        </div>
      </div>
    </div>
    </body>
