<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Message de bienvenue -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Bienvenue, {{ Auth::user()->prenom }} !</h3>
                    <p class="text-gray-600">Gérez votre compte et vos réservations depuis cette interface.</p>
                </div>
            </div>

            <!-- Informations du compte -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Mon compte</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informations personnelles -->
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Informations personnelles</h4>
                            <div class="space-y-2">
                                <p><span class="font-medium">Nom complet :</span> {{ Auth::user()->prenom }} {{ Auth::user()->nom }}</p>
                                <p><span class="font-medium">Email :</span> {{ Auth::user()->email }}</p>
                                <p><span class="font-medium">Téléphone :</span> {{ Auth::user()->telephone ?? 'Non renseigné' }}</p>
                                <p><span class="font-medium">Adresse :</span> {{ Auth::user()->adresse ?? 'Non renseignée' }}</p>
                                <p><span class="font-medium">Ville :</span> {{ Auth::user()->ville ?? 'Non renseignée' }}</p>
                            </div>
                            
                            <div class="mt-4">
                                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Modifier mes informations
                                </a>
                            </div>
                        </div>

                        <!-- Dernières réservations -->
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Dernières réservations</h4>
                            @if(Auth::user()->reservations->count() > 0)
                                <div class="space-y-4">
                                    @foreach(Auth::user()->reservations()->latest()->take(3)->get() as $reservation)
                                        <div class="border rounded-lg p-3">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    @if($reservation->vehicule)
                                                        <p class="font-medium">{{ $reservation->vehicule->modele }}</p>
                                                    @else
                                                        <p class="font-medium text-gray-500">Véhicule non disponible</p>
                                                    @endif
                                                    <p class="text-sm text-gray-600">
                                                        Du {{ $reservation->date_debut->format('d/m/Y') }} au {{ $reservation->date_fin->format('d/m/Y') }}
                                                    </p>
                                                    <span class="inline-block mt-1 px-2 py-1 text-xs font-semibold rounded-full 
                                                        {{ $reservation->statut === 'confirmee' ? 'bg-green-100 text-green-800' : 
                                                        ($reservation->statut === 'en_attente' ? 'bg-yellow-100 text-yellow-800' : 
                                                        ($reservation->statut === 'annulee' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                                        {{ ucfirst($reservation->statut) }}
                                                    </span>
                                                </div>
                                                <span class="text-gray-500 text-sm">
                                                    Détails non disponibles
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4">
                                    <span class="text-gray-500 text-sm font-medium">
                                        Fonctionnalité à venir
                                    </span>
                                </div>
                            @else
                                <p class="text-gray-500 italic">Vous n'avez pas encore effectué de réservation.</p>
                                <a href="{{ route('vehicules.index') }}" class="inline-block mt-3 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                    Voir les véhicules disponibles
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('vehicules.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 transition-colors border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Voir les véhicules</h3>
                            <p class="mt-1 text-sm text-gray-500">Parcourez notre sélection de véhicules de luxe</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 transition-colors border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-100 p-3 rounded-full">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Profil</h3>
                            <p class="mt-1 text-sm text-gray-500">Gérez vos informations personnelles</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('reservations.create') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 transition-colors border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-100 p-3 rounded-full">
                            <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Nouvelle réservation</h3>
                            <p class="mt-1 text-sm text-gray-500">Réservez votre prochain véhicule</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
