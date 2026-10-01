@extends('layouts.app')

@section('title', 'Mon Panier - AutoPrestige CI')

@section('content')
<div class="mx-auto w-full max-w-7xl flex-1 px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    <div class="layout-content-container flex flex-col">
        <div class="flex flex-wrap justify-between gap-3 p-4">
            <div class="flex items-center gap-4">
                <h2 class="text-gray-900 text-4xl font-black tracking-tighter">Mon Panier AutoPrestige</h2>
                <img src="{{ asset('images/ci-flag.png') }}" alt="Drapeau ivoirien" class="w-8 h-auto rounded shadow">
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 xl:gap-12 mt-8">
            <div class="lg:col-span-2 flex flex-col gap-6">
                @php
                    $vehiculesPanier = [
                        [
                            'id' => 1,
                            'image' => 'https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'prix' => '25 000 000 FCFA',
                            'modele' => 'Mercedes Classe S 500',
                            'localisation' => 'Abidjan - Plateau',
                            'annee' => 2024,
                            'kilometrage' => '15 200 km',
                            'carburant' => 'Hybride Rechargeable',
                            'boite' => 'Automatique 9G-TRONIC'
                        ],
                        [
                            'id' => 2,
                            'image' => 'https://images.unsplash.com/photo-1580273916551-e352023c546e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'prix' => '18 000 000 FCFA',
                            'modele' => 'Range Rover Vogue',
                            'localisation' => 'Cocody - Riviera',
                            'annee' => 2024,
                            'kilometrage' => '22 500 km',
                            'carburant' => 'Diesel',
                            'boite' => 'Automatique 8 vitesses'
                        ],
                        [
                            'id' => 3,
                            'image' => 'https://images.unsplash.com/photo-1503376785-2acd72611164?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                            'prix' => '32 000 000 FCFA',
                            'modele' => 'Porsche 911 Carrera S',
                            'localisation' => 'Abidjan - Marcory',
                            'annee' => 2024,
                            'kilometrage' => '12 300 km',
                            'carburant' => 'Essence',
                            'boite' => 'PDK 8 vitesses'
                        ]
                    ];
                @endphp

                @foreach($vehiculesPanier as $vehicule)
                <div class="flex flex-col md:flex-row items-stretch justify-between gap-4 rounded-xl bg-white p-4 shadow-sm border border-gray-200">
                    <div class="w-full md:w-1/3 bg-center bg-no-repeat aspect-video md:aspect-auto bg-cover rounded-lg" style='background-image: url("{{ $vehicule['image'] }}");'></div>
                    <div class="flex flex-[2_2_0px] flex-col gap-4">
                        <div class="flex flex-col gap-1">
                            <p class="text-gray-500 text-sm font-normal">{{ $vehicule['prix'] }}</p>
                            <p class="text-gray-900 text-lg font-bold">{{ $vehicule['modele'] }}</p>
                            <p class="text-amber-600 text-sm font-medium">Disponible à {{ $vehicule['localisation'] }}</p>
                            <p class="text-gray-500 text-sm font-normal">Année: {{ $vehicule['annee'] }}, {{ $vehicule['kilometrage'] }}, {{ $vehicule['carburant'] }}, {{ $vehicule['boite'] }}</p>
                        </div>
                        <div class="mt-auto">
                            <button class="w-full flex items-center justify-center gap-2 py-2 px-4 text-red-500 hover:bg-red-50 rounded-lg transition-colors border border-red-200">
                                <span class="material-symbols-outlined text-base">delete</span>
                                <span class="font-medium">Retirer du panier</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Résumé -->
            <aside class="lg:col-span-1">
                <div class="sticky top-28 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-gray-200">
                        <span class="material-symbols-outlined text-primary text-2xl">shopping_bag</span>
                        <h3 class="text-gray-900 text-[22px] font-bold tracking-tight">Ma Sélection</h3>
                    </div>
                    <div class="space-y-4 py-6">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-600">Mercedes Classe S 500</span>
                            <span class="font-medium text-gray-800">25 000 000 FCFA</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-600">Range Rover Vogue</span>
                            <span class="font-medium text-gray-800">18 000 000 FCFA</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-600">Porsche 911 Carrera S</span>
                            <span class="font-medium text-gray-800">32 000 000 FCFA</span>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 pt-6 space-y-4">
                        <div class="flex justify-between items-baseline">
                            <span class="text-lg font-bold text-gray-900">Total estimé</span>
                            <div class="text-right">
                                <p class="text-xl font-bold text-gray-900">75 000 000 FCFA</p>
                                <p class="text-sm text-gray-500">Total pour 3 véhicules</p>
                            </div>
                        </div>
                        <div class="bg-amber-50 p-3 rounded-lg text-center">
                    <p class="text-xs text-amber-700">
                        <span class="font-semibold">Service client 24/7 :</span> Appelez-nous au <a href="tel:+2250700000000" class="font-bold hover:underline">+225 07 00 00 00 00</a>
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Paiement sécurisé et livraison sur toute la Côte d'Ivoire</p>
                </div>
                        <a href="{{ route('confirmation') }}" class="block w-full bg-primary hover:bg-primary/90 text-white text-center font-bold py-3 px-4 rounded-lg transition-colors mt-4">
                            Procéder au paiement
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<!-- Footer mobile -->
<footer class="sticky bottom-0 z-40 bg-white/90 backdrop-blur-sm border-t border-gray-200 lg:hidden">
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-col w-full gap-2">
            <a href="{{ route('confirmation') }}" class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-base font-bold shadow-sm hover:bg-primary/90 transition-colors">
                <span>Payer maintenant</span>
                <span class="ml-2">➜</span>
            </a>
            <p class="text-xs text-center text-gray-500">Paiement sécurisé par MTN Moov, Orange Money et Carte Bancaire</p>
        </div>
    </div>
</footer>
@endsection
