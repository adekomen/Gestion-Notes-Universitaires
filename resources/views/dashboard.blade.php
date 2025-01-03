<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700">Nombre total d'UE</h3>
                    <p class="text-4xl font-bold text-blue-500 mt-4">{{ $totalUE }}</p>
                </div>

                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700">Nombre total d'EC</h3>
                    <p class="text-4xl font-bold text-green-500 mt-4">{{ $totalEC }}</p>
                </div>

                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700">Éléments Constitutifs par UE</h3>
                    <ul class="mt-4 space-y-2">
                        @foreach ($ueWithEcCount as $ue)
                            <li class="text-sm text-gray-600">
                                <span class="font-medium text-gray-800">{{ $ue->nom }}</span> :
                                <span class="text-gray-500">{{ $ue->ec_count }} EC</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6 mt-8">
                <h3 class="text-lg font-semibold text-gray-700">Statistiques Générales</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <p class="text-sm text-gray-600">Pourcentage des EC attribués à chaque UE</p>
                        @foreach ($ueWithEcCount as $ue)
                            @php
                                $percentage = $totalEC > 0 ? round(($ue->ec_count / $totalEC) * 100, 2) : 0;
                                $progressBarWidth = 'w-' . intval($percentage); // Utilisation des classes dynamiques
                            @endphp
                            <div class="mt-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-700">{{ $ue->nom }}</span>
                                    <span class="text-sm text-gray-500">{{ $percentage }}%</span>
                                </div>
                                <div class="bg-gray-200 rounded-full h-2 mt-1">
                                    <div class="bg-blue-500 h-2 rounded-full {{ $progressBarWidth }}"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Graphiques ou autres analyses à venir...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
