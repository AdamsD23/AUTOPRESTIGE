@extends('layouts.app')

@section('title', 'Détails de location - AutoPrestige')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-wrap gap-2 mb-6">
        <a class="text-gray-500 text-sm font-medium leading-normal hover:text-primary transition-colors" href="{{ route('accueil') }}">Accueil</a>
        <span class="text-gray-500 text-sm font-medium leading-normal">/</span>
        <a class="text-gray-500 text-sm font-medium leading-normal hover:text-primary transition-colors" href="{{ route('vehicules') }}">Notre flotte</a>
        <span class="text-gray-500 text-sm font-medium leading-normal">/</span>
        <span class="text-gray-800 text-sm font-medium leading-normal">Détails de location</span>
    </div>
    <div class="flex flex-wrap justify-between gap-3 mb-8">
        <div>
            <h1 class="text-gray-900 text-4xl font-black leading-tight tracking-[-0.033em]">{{ $vehicule['modele'] }} ({{ $vehicule['annee'] }})</h1>
            <p class="text-gray-600 mt-2">{{ $vehicule['categorie'] }}</p>
        </div>
        <div class="bg-blue-50 px-6 py-3 rounded-lg">
            <p class="text-sm text-gray-600">À partir de</p>
            <p class="text-3xl font-bold text-primary">{{ number_format($vehicule['prix'], 0, ',', ' ') }} FCFA <span class="text-base font-normal">/ jour</span></p>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="grid grid-cols-1 gap-4">
                <!-- Image principale -->
                <div class="w-full bg-gray-100 rounded-xl overflow-hidden">
                    <div id="mainImage" class="w-full h-[500px] bg-center bg-no-repeat bg-cover transition-all duration-300" style="background-image: url('{{ $vehicule['images'][0] }}');"></div>
                </div>
                
                <!-- Miniatures des différentes vues -->
                <div class="flex flex-wrap gap-3">
                    @php
                        $viewNames = ['Vue avant', 'Vue arrière', 'Vue côté', 'Intérieur', 'Tableau de bord', 'Coffre'];
                    @endphp
                    
                    @foreach($vehicule['images'] as $index => $image)
                        @php
                            $viewName = $viewNames[$index] ?? 'Vue ' . ($index + 1);
                        @endphp
                        <div class="flex flex-col items-center group">
                            <button 
                                onclick="changeMainImage(this, '{{ $image }}')" 
                                class="w-24 h-16 md:w-32 md:h-20 rounded-lg overflow-hidden border-2 {{ $index === 0 ? 'border-primary' : 'border-transparent' }} hover:border-primary transition-all duration-200"
                                data-image="{{ $image }}"
                                data-view="{{ $viewName }}"
                            >
                                <div class="w-full h-full bg-center bg-cover bg-no-repeat" style="background-image: url('{{ $image }}');"></div>
                            </button>
                            <span class="mt-1 text-xs text-gray-600">{{ $viewName }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="lg:col-span-1">
            <div class="sticky top-24 bg-white p-6 rounded-xl shadow-md border border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">{{ $vehicule['modele'] }}</h2>
                <p class="text-3xl font-black text-primary mt-2">{{ number_format($vehicule['prix'], 0, ',', ' ') }} FCFA</p>
                <p class="text-sm text-gray-500">ou {{ number_format($vehicule['prix'] / 30, 0, ',', ' ') }} FCFA / jour</p>
                <div class="mt-6 border-t border-gray-200 pt-6">
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-center">
                            <span class="material-symbols-outlined text-primary text-xl mr-3">speed</span>
                            <span class="font-medium text-gray-700">Kilométrage:</span>
                            <span class="ml-auto text-gray-900 font-semibold">{{ $vehicule['kilometrage'] ?? 'Non spécifié' }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="material-symbols-outlined text-primary text-xl mr-3">local_gas_station</span>
                            <span class="font-medium text-gray-700">Carburant:</span>
                            <span class="ml-auto text-gray-900 font-semibold">{{ $vehicule['carburant'] }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="material-symbols-outlined text-primary text-xl mr-3">settings</span>
                            <span class="font-medium text-gray-700">Boîte de vitesses:</span>
                            <span class="ml-auto text-gray-900 font-semibold">{{ $vehicule['boite'] }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="material-symbols-outlined text-primary text-xl mr-3">person</span>
                            <span class="font-medium text-gray-700">Places:</span>
                            <span class="ml-auto text-gray-900 font-semibold">{{ $vehicule['places'] }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="material-symbols-outlined text-primary text-xl mr-3">bolt</span>
                            <span class="font-medium text-gray-700">Puissance:</span>
                            <span class="ml-auto text-gray-900 font-semibold">{{ $vehicule['puissance'] }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="material-symbols-outlined text-primary text-xl mr-3">speed</span>
                            <span class="font-medium text-gray-700">Accélération (0-100 km/h):</span>
                            <span class="ml-auto text-gray-900 font-semibold">{{ $vehicule['acceleration'] }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="material-symbols-outlined text-primary text-xl mr-3">local_gas_station</span>
                            <span class="font-medium text-gray-700">Consommation:</span>
                            <span class="ml-auto text-gray-900 font-semibold">{{ $vehicule['consommation'] }}</span>
                        </li>
                    </ul>
                </div>
                <div class="mt-8 flex flex-col gap-3">
                    <a href="{{ route('panier') }}" class="w-full flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors">
                        <span class="material-symbols-outlined mr-2">shopping_cart</span>
                        <span class="truncate">Ajouter au panier</span>
                    </a>
                    <button class="w-full flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-primary/20 text-primary text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/30 transition-colors">
                        <span class="truncate">Réserver ce véhicule</span>
                    </button>
                    <button class="w-full text-center text-sm text-gray-500 hover:text-primary mt-2 transition-colors">Demander un essai</button>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-12">
        <div class="bg-gray-50 p-6 rounded-xl mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Réserver ce véhicule</h2>
            <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date de départ</label>
                    <input type="date" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date de retour</label>
                    <input type="date" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lieu de prise en charge</label>
                    <select class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/50">
                        <option>Abidjan - Plateau</option>
                        <option>Abidjan - Aéroport FHB</option>
                        <option>Abidjan - Cocody</option>
                        <option>Abidjan - Marcory</option>
                        <option>Yamoussoukro - Centre</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-2 px-4 rounded-lg h-[42px] transition-colors">
                        Réserver maintenant
                    </button>
                </div>
            </form>
        </div>

        <div class="py-8 space-y-12">
            <!-- Introduction -->
            <div class="prose prose-lg max-w-none text-gray-700">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Présentation</h2>
                <p>{{ $vehicule['description']['introduction'] }}</p>
                <p>Ce modèle {{ $vehicule['annee'] }}, avec seulement {{ $vehicule['kilometrage'] ?? 'peu de kilomètres' }} au compteur, est en excellent état. Équipé d'un moteur {{ strtolower($vehicule['carburant']) }} performant associé à une {{ $vehicule['boite'] }}, il offre une expérience de conduite dynamique et réactive, adaptée aussi bien à la ville qu'aux longs trajets.</p>
            </div>

            <!-- Caractéristiques techniques -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Caractéristiques techniques</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($vehicule['description']['caracteristiques'] as $caracteristique)
                        <div class="flex items-start">
                            <span class="text-primary mr-2">✓</span>
                            <span class="text-gray-700">{{ $caracteristique }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Intérieur -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Intérieur et équipements</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>{{ $vehicule['description']['interieur'] }}</p>
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Équipements principaux :</h3>
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            @foreach($vehicule['equipements'] as $equipement)
                                <li class="flex items-center">
                                    <span class="material-symbols-outlined text-primary mr-2 text-sm">check_circle</span>
                                    <span>{{ $equipement }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Confort et technologie -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Confort et technologie</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    <p>{{ $vehicule['description']['confort'] }}</p>
                </div>
            </div>

            <!-- Disponibilité -->
            <div class="mt-12 bg-blue-50 p-6 rounded-xl">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Disponible dès maintenant</h3>
                        <p class="text-gray-600 mt-1">Réservez dès aujourd'hui pour une expérience de conduite exceptionnelle</p>
                    </div>
                    <a href="#reservation" class="bg-primary hover:bg-primary/90 text-white font-bold py-3 px-6 rounded-lg transition-colors whitespace-nowrap">
                        Réserver ce véhicule
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function changeMainImage(button, imageUrl = null) {
        const mainImage = document.getElementById('mainImage');
        const url = imageUrl || button.getAttribute('data-image');
        
        // Effet de fondu
        mainImage.style.opacity = '0.5';
        
        // Changer l'image de fond avec un effet de transition
        setTimeout(() => {
            mainImage.style.backgroundImage = `url('${url}')`;
            mainImage.style.opacity = '1';
        }, 150);
        
        // Mettre à jour les styles des boutons
        const allButtons = document.querySelectorAll('[onclick*="changeMainImage"]');
        allButtons.forEach(btn => {
            btn.classList.remove('border-primary');
            btn.classList.add('border-transparent');
        });
        
        // Ajouter le style actif au bouton cliqué
        if (button) {
            button.classList.add('border-primary');
            button.classList.remove('border-transparent');
        }
        
        // Mettre à jour le nom de la vue actuelle (si disponible)
        const viewName = button ? button.getAttribute('data-view') : '';
        const viewIndicator = document.getElementById('currentView');
        if (viewIndicator && viewName) {
            viewIndicator.textContent = viewName;
        }
    }
    
    // Rotation automatique des images toutes les 5 secondes
    document.addEventListener('DOMContentLoaded', function() {
        const images = @json($vehicule['images']);
        let currentIndex = 0;
        
        if (images.length > 1) {
            setInterval(() => {
                currentIndex = (currentIndex + 1) % images.length;
                const button = document.querySelector(`[data-image="${images[currentIndex]}"]`);
                if (button) {
                    changeMainImage(button, images[currentIndex]);
                }
            }, 5000);
        }
    });
</script>
@endsection
