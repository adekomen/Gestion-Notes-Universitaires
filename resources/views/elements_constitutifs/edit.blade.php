<x-app-layout>
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Modifier un Élément Constitutif</h2>

        <form action="{{ route('elements_constitutifs.update', $ec->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">Code EC</label>
                    <input type="text" name="code" id="code" value="{{ $ec->code }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="nom" id="nom" value="{{ $ec->nom }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="coefficient" class="block text-sm font-medium text-gray-700">Coefficient</label>
                    <input type="number" name="coefficient" id="coefficient" value="{{ $ec->coefficient }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" min="1" max="5">
                </div>
                <div>
                    <label for="ue_id" class="block text-sm font-medium text-gray-700">Unité d'Enseignement</label>
                    <select name="ue_id" id="ue_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @foreach ($ues as $ue)
                            <option value="{{ $ue->id }}" @if($ec->ue_id == $ue->id) selected @endif>
                                {{ $ue->code }} - {{ $ue->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('elements_constitutifs.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
