@extends('layouts.app')

@section('title', 'Notre flotte de location - AutoPrestige')

@push('styles')
<style>
    .vehicle-card {
        transition: all 0.3s ease;
    }
    .vehicle-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .badge-category {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .specs-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 0.25rem;
    }
</style>
@endpush

@section('content')
<section class="py-12 sm:py-16 lg:py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Notre flotte d'exception</h1>
            <div class="w-24 h-1.5 bg-gradient-to-r from-primary to-blue-500 mx-auto mb-6"></div>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Découvrez notre sélection exclusive de véhicules haut de gamme, soigneusement entretenus et disponibles pour répondre à toutes vos exigences de mobilité.
            </p>
        </div>
        
        <!-- Filtres -->
        <div class="mb-12 p-6 bg-white rounded-xl shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="w-full md:w-1/3">
                    <label for="categorie" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                    <select id="categorie" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                        <option value="">Toutes les catégories</option>
                        <option value="Berline">Berlines</option>
                        <option value="SUV">SUV</option>
                        <option value="Sportive">Sportives</option>
                        <option value="4x4">4x4</option>
                    </select>
                </div>
                <div class="w-full md:w-1/3">
                    <label for="carburant" class="block text-sm font-medium text-gray-700 mb-1">Carburant</label>
                    <select id="carburant" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                        <option value="">Tous les carburants</option>
                        <option value="Essence">Essence</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Hybride">Hybride</option>
                        <option value="Électrique">Électrique</option>
                    </select>
                </div>
                <div class="w-full md:w-1/3 flex items-end">
                    <button class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                        Filtrer les véhicules
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Grille des véhicules -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($vehicules as $vehicule)
                <div class="vehicle-card bg-white rounded-xl overflow-hidden border border-gray-200 shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="relative">
                        <a href="{{ route('vehicule.detail', ['id' => $vehicule['id']]) }}" class="block overflow-hidden">
                            <img class="h-56 w-full object-cover hover:scale-105 transition-transform duration-500" 
                                 src="{{ $vehicule['image'] }}" 
                                 alt="{{ $vehicule['modele'] }}"/>
                        </a>
                        <span class="badge-category">{{ $vehicule['categorie'] }}</span>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                            <h3 class="text-xl font-bold text-white">{{ $vehicule['modele'] }}</h3>
                            <p class="text-primary-200 text-sm">À partir de <span class="text-xl font-bold text-white">{{ number_format($vehicule['prix'], 0, ',', ' ') }} FCFA</span> /jour</p>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <div class="grid grid-cols-4 gap-1 mb-3 text-xs text-gray-600">
                            <div class="flex flex-col items-center text-center">
                                <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="truncate w-full">{{ $vehicule['annee'] }}</span>
                            </div>
                            <div class="flex flex-col items-center text-center">
                                <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span class="truncate w-full">{{ $vehicule['puissance'] }}</span>
                            </div>
                            <div class="flex flex-col items-center text-center">
                                <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="truncate w-full">{{ $vehicule['acceleration'] }}</span>
                            </div>
                            <div class="flex flex-col items-center text-center">
                                <svg class="w-4 h-4 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                </svg>
                                <span class="truncate w-full">{{ $vehicule['carburant'] }}</span>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h4 class="font-semibold text-gray-900 mb-2">Équipements principaux :</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach(array_slice($vehicule['equipements'], 0, 3) as $equipement)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $equipement }}
                                    </span>
                                @endforeach
                                @if(count($vehicule['equipements']) > 3)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        +{{ count($vehicule['equipements']) - 3 }} plus
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3 mt-6">
                            <a href="{{ route('vehicule.detail', ['id' => $vehicule['id']]) }}" class="flex-1 bg-primary hover:bg-primary/90 text-white text-center font-bold py-3 px-6 rounded-lg transition-colors">
                                Détails
                            </a>
                            <a href="{{ route('contact') }}" class="flex-1 bg-white hover:bg-gray-50 text-primary text-center font-bold py-3 px-6 border border-primary rounded-lg transition-colors">
                                Réserver
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination ou message si pas de véhicules -->
        @if(count($vehicules) === 0)
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Aucun véhicule trouvé</h3>
                <p class="mt-1 text-gray-500">Aucun véhicule ne correspond à vos critères de recherche.</p>
            </div>
        @endif
    </div>
</section>

<!-- Section CTA -->
<section class="bg-gradient-to-r from-primary to-blue-600 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Vous ne trouvez pas le véhicule idéal ?</h2>
        <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-8">
            Notre équipe se tient à votre disposition pour vous aider à trouver le véhicule parfaitement adapté à vos besoins.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('contact') }}" class="bg-white hover:bg-gray-100 text-primary font-bold py-3 px-8 rounded-lg transition-colors">
                Nous contacter
            </a>
            <a href="tel:+2250707070707" class="bg-transparent hover:bg-white/10 border-2 border-white text-white font-bold py-3 px-8 rounded-lg transition-colors">
                <span class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    +225 07 07 07 07 07
                </span>
            </a>
        </div>
    </div>
</section>
@endsection
