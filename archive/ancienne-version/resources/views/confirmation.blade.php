t@extends('layouts.app')

@section('title', 'Récapitulatif Commande/Réservation')

@section('content')
<div class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    <div class="flex flex-col gap-8">
        <!-- Breadcrumbs & Heading -->
        <div class="flex flex-col gap-4">
            <div class="flex flex-wrap items-center gap-2">
                <a class="text-sm font-medium leading-normal text-gray-500 hover:text-primary" href="{{ route('panier') }}">Panier</a>
                <span class="material-symbols-outlined text-lg text-gray-400">chevron_right</span>
                <span class="text-sm font-medium leading-normal text-[#111418]">Récapitulatif</span>
                <span class="material-symbols-outlined text-lg text-gray-400">chevron_right</span>
                <span class="text-sm font-medium leading-normal text-gray-500">Paiement</span>
            </div>
            <div class="flex flex-wrap justify-between items-baseline gap-3">
                <div class="flex flex-col gap-2">
                    <p class="text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em] text-[#111418]">Récapitulatif de votre commande</p>
                    <p class="text-base font-normal leading-normal text-gray-600">Veuillez vérifier les détails avant de confirmer.</p>
                </div>
            </div>
        </div>

        <!-- Two-column layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
            <!-- Left Column: Vehicle List -->      
            <div class="lg:col-span-2 flex flex-col gap-6">
                <h3 class="text-xl font-bold text-[#111418]">Vos Véhicules (2)</h3>

                <!-- Vehicle Card 1: Purchase -->
                <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-4">
                    <div class="flex flex-col sm:flex-row items-stretch justify-between gap-6">
                        <div class="w-full sm:w-1/3 h-40 sm:h-auto bg-center bg-no-repeat bg-cover rounded-lg" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA8BKuLuVHHxWCuHdi1nGC4yTuSJ9CaRNJlMniwUho0f-E8huT-nBE3Dy98y2UrgdFjnjMBAiLZHXaYIjaeiPnVg7H_xKEa0sL8J1HUuU_aX5kYNs--kjpKK16BJhgcSCvvy-J-zaKnxt2eHFZfs-7fBQLrSyL2qBijnbbvSZgGw8X6EufjFJCSPYpjoZijaT-IxFm2o8pVuHxA3yyZklrMPWH1mvOLD_8oZMvD4GQ9CoP3lTAWggUXOI7Dr7HFsyMZTz_ycoY1wGsf");'></div>
                        <div class="flex flex-1 flex-col justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-xs font-medium uppercase tracking-wider text-primary">Achat</p>
                                        <p class="text-lg font-bold leading-tight text-[#111418]">Renault Clio V (2023)</p>
                                    </div>
                                    <p class="text-lg font-bold text-[#111418]">22 500 €</p>
                                </div>
                                <p class="text-sm font-normal leading-normal text-gray-600">15,000 km, Essence</p>
                            </div>
                            <button class="flex w-fit cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-3 gap-1 text-sm font-medium text-gray-600 hover:bg-zinc-100">
                                <span class="material-symbols-outlined text-base">delete</span>
                                <span class="truncate">Retirer</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Card 2: Rental -->
                <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-4">
                    <div class="flex flex-col sm:flex-row items-stretch justify-between gap-6">
                        <div class="w-full sm:w-1/3 h-40 sm:h-auto bg-center bg-no-repeat bg-cover rounded-lg" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDYaKQ6JiSZ1w5LnSe3jwLIY1VV8MsIG0HkwsQblPTMeHuKDQwHsZwP3u5SXRGfnzCA2CFlkRyac04J6QMHRfSEGzqm-RzzEccMwvtOBZW5q1_STgIAYAQVutddjRmlXQjXaVL2zPYJpirv_W-ODd5Pa0bmuDpAJ_EZLkEIu2FhAnu3WQ603MzUSLtIUS2uWCpfW5M3nBUAEv7FknkurMq9r8DB2JX1eMQG7bFMP4pLK2r6Ae1AbWec24wkUjOqu1POXbofdeyIACY4");'></div>
                        <div class="flex flex-1 flex-col justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-xs font-medium uppercase tracking-wider text-green-600">Location (7 jours)</p>
                                        <p class="text-lg font-bold leading-tight text-[#111418]">Peugeot 2008 (2022)</p>
                                    </div>
                                    <p class="text-lg font-bold text-[#111418]">490 €</p>
                                </div>
                                <p class="text-sm font-normal leading-normal text-gray-600">5,000 km, Electrique</p>
                            </div>
                            <button class="flex w-fit cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-3 gap-1 text-sm font-medium text-gray-600 hover:bg-zinc-100">
                                <span class="material-symbols-outlined text-base">delete</span>
                                <span class="truncate">Retirer</span>
                            </button>
                        </div>
                    </div>
                </div>

                <a class="group flex items-center gap-2 text-sm font-medium text-primary hover:underline w-fit" href="{{ route('panier') }}">
                    <span class="material-symbols-outlined text-xl transition-transform group-hover:-translate-x-1">arrow_back</span>
                    <span>Modifier ma sélection</span>
                </a>
            </div>

            <!-- Right Column: Summary Box -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 flex flex-col gap-6 bg-white p-6 rounded-xl shadow-sm border border-zinc-200">
                    <h3 class="text-xl font-bold text-[#111418]">Résumé de la commande</h3>

                    <!-- Price breakdown -->
                    <div class="flex flex-col gap-3 border-b border-zinc-200 pb-4">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Sous-total véhicules</span>
                            <span>22 990,00 €</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Frais de dossier</span>
                            <span>150,00 €</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Taxe écologique</span>
                            <span>50,00 €</span>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="flex justify-between items-baseline">
                        <span class="text-lg font-bold text-[#111418]">Total TTC</span>
                        <span class="text-2xl font-black text-[#111418]">23 190,00 €</span>
                    </div>

                    <!-- CTA -->
                    <a href="{{ route('paiement') }}" class="flex w-full min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors">
                        <span class="truncate">Confirmer et passer au paiement</span>
                    </a>

                    <!-- Security Info -->
                    <div class="flex items-center justify-center gap-2 text-xs text-gray-500">
                        <span class="material-symbols-outlined text-base">lock</span>
                        <span>Paiement sécurisé par SSL</span>
                    </div>

                    <!-- Help Section -->
                    <div class="mt-4 border-t border-zinc-200 pt-4 text-center">
                        <p class="text-sm text-gray-600">Une question ?</p>
                        <a class="text-sm font-medium text-primary hover:underline" href="{{ route('contact') }}">Contactez notre support</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
