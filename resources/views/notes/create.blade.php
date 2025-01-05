@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mx-auto max-w-lg p-6 bg-white shadow-md rounded-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Ajouter une note</h1>
    <form action="{{ route('notes.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="form-group">
            <label for="etudiant_id" class="block text-sm font-medium text-gray-700 mb-2">Étudiant</label>
            <select name="etudiant_id" id="etudiant_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @foreach($etudiants as $etudiant)
                <option value="{{ $etudiant->id }}">{{ $etudiant->id }} - {{ $etudiant->nom }}</option>
                @endforeach
            </select>
        </div>

         <div class="form-group">
            <label for="ec_id" class="block text-sm font-medium text-gray-700 mb-2">Élément Constitutif</label>
            {{-- <select name="ec_id" id="ec_id" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @foreach($ecs as $ec)
                    <option value="{{ $ec->id }}">{{ $ec->code }} - {{ $ec->nom }}</option>
                @endforeach
            </select> --}}
        </div>
        <div class="form-group">
            <label for="ue_id">Unité d'Enseignement (UE)</label>
            <select name="ue_id" id="ue_id" class="form-control" required>
                <option value="{{ $ue->id }}">{{ $ue->nom }}</option> <!-- Afficher le nom de l'UE -->
            </select>
        </div>

        <div class="form-group">
            <label for="ec_id">Choisir un EC</label>
            <select name="ec_id" id="ec_id" class="form-control" required>
                @foreach($ecs as $ec)
                    <option value="{{ $ec->id }}">{{ $ec->nom }}</option> <!-- Afficher le nom de l'EC -->
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date_evaluation" class="block text-sm font-medium text-gray-700 mb-2">Date de l'évaluation</label>
            <input type="date" name="date_evaluation" id="date_evaluation" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
        </div>

         <div class="form-group">
            <label for="note" class="block text-sm font-medium text-gray-700 mb-2">Note</label>
            <input type="number" name="note" id="note" min="0" max="20" step="0.25" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
        </div>

        <div class="form-group">
            <label for="session" class="block text-sm font-medium text-gray-700 mb-2">Session</label>
            <select name="session" id="session" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="normale">Session Normale</option>
                <option value="rattrapage">Rattrapage</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">
            Enregistrer
        </button>
    </form>
</div>
