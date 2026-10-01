@extends('layouts.app')

@section('title', 'Paiement/Confirmation Réservation')

@section('content')
<div class="layout-container flex h-full grow flex-col items-center py-8 sm:py-12 px-4">
    <div class="layout-content-container flex flex-col w-full max-w-6xl flex-1 gap-8">
        <!-- Breadcrumbs -->
        <div class="flex flex-wrap gap-2 items-center">
            <a class="text-[#617589] text-sm font-medium leading-normal hover:text-primary" href="{{ route('vehicules') }}">Véhicule</a>
            <span class="material-symbols-outlined text-sm text-[#617589]">chevron_right</span>
            <a class="text-[#617589] text-sm font-medium leading-normal hover:text-primary" href="#">Options</a>
            <span class="material-symbols-outlined text-sm text-[#617589]">chevron_right</span>
            <span class="text-primary text-sm font-bold leading-normal">Paiement</span>
            <span class="material-symbols-outlined text-sm text-[#617589]">chevron_right</span>
            <span class="text-[#617589] text-sm font-medium leading-normal">Confirmation</span>
        </div>

        <!-- PageHeading -->
        <div class="flex flex-wrap justify-between gap-3">
            <div class="flex min-w-72 flex-col gap-2">
                <p class="text-[#111418] text-4xl font-black leading-tight tracking-[-0.033em]">Paiement Sécurisé</p>
                <p class="text-[#617589] text-base font-normal leading-normal">Finalisez votre transaction en toute sécurité</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <!-- Left Column: Payment Form -->
            <div class="lg:col-span-2 w-full bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] p-6 sm:p-8 space-y-8">
                <div>
                    <h3 class="text-xl font-bold text-[#111418] mb-6">Informations de Paiement</h3>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-[#617589] mb-1.5" for="card-holder">Nom sur la carte</label>
                                <input class="w-full rounded-lg border border-gray-300 bg-transparent px-3 py-2 text-sm focus:border-primary focus:ring-primary" id="card-holder" name="card-holder" placeholder="Jean Dupont" type="text"/>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-[#617589] mb-1.5" for="card-number">Numéro de carte</label>
                                <div class="relative">
                                    <input class="w-full rounded-lg border border-gray-300 bg-transparent pl-3 pr-12 py-2 text-sm focus:border-primary focus:ring-primary" id="card-number" name="card-number" placeholder="•••• •••• •••• ••••" type="text"/>
                                    <span class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                                        <span class="material-symbols-outlined">credit_card</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-[#617589] mb-1.5" for="expiry-date">Date d'expiration</label>
                                <input class="w-full rounded-lg border border-gray-300 bg-transparent px-3 py-2 text-sm focus:border-primary focus:ring-primary" id="expiry-date" name="expiry-date" placeholder="MM/AA" type="text"/>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-[#617589] mb-1.5" for="cvv">CVV</label>
                                <div class="relative">
                                    <input class="w-full rounded-lg border border-gray-300 bg-transparent pl-3 pr-10 py-2 text-sm focus:border-primary focus:ring-primary" id="cvv" name="cvv" placeholder="•••" type="text"/>
                                    <span class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                                        <span class="material-symbols-outlined text-base">help_outline</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center pt-4">
                            <input class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary" id="save-card" name="save-card" type="checkbox"/>
                            <label class="ml-2 block text-sm text-[#617589]" for="save-card">Enregistrer cette carte pour mes prochains achats</label>
                        </div>
                    </form>
                </div>
                <div class="border-t border-gray-200 pt-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 text-sm text-green-600">
                            <span class="material-symbols-outlined">lock</span>
                            <p class="font-medium">Paiement 100% sécurisé</p>
                        </div>
                        <button class="flex w-auto cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-primary text-white gap-2 text-base font-bold leading-normal tracking-[0.015em] px-8 hover:bg-primary/90 transition-colors">
                            <span>Payer 474.00€</span>
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="lg:col-span-1 w-full space-y-6 sticky top-28">
                <div class="p-6 bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)]">
                    <div class="flex flex-col items-stretch justify-start">
                        <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg mb-4" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBTbYqYfq0KZhe3WH0OcVo5qILCFi8DfZP3rYXvTYpN_LBGD2L8CY8nkpGhbpJ4jQ6nahRyvMge1FkhEpHzO06F28PGpLeJfe9WHaSi-ts_XlQ_7XKnJvZgWXT7F24UNF-bIxb6bVWEOK-4CyE1KLM1LhVppIWnf23eODlgrlGE5dObFM5pOkDbLTtT5nUbzdXQ2fELnzpAlD_3mMyTH9RDj15OjGPSJ5YcYWrtShtPh-liB_sbFQtRWgP9Pph0BwYPyEG9IzV6Gjwm');"></div>
                        <div class="flex w-full min-w-72 grow flex-col items-stretch justify-center gap-1">
                            <p class="text-[#617589] text-sm font-normal leading-normal">Récapitulatif de votre location</p>
                            <p class="text-[#111418] text-lg font-bold leading-tight tracking-[-0.015em]">Renault Clio V</p>
                            <div class="flex flex-col gap-2 mt-2">
                                <p class="text-[#617589] text-sm font-normal leading-normal">Berline, Essence, Automatique</p>
                                <p class="text-[#617589] text-sm font-normal leading-normal">Retrait: 10 Juil 2024, Paris Charles de Gaulle</p>
                                <p class="text-[#617589] text-sm font-normal leading-normal">Retour: 17 Juil 2024, Lyon Saint-Exupéry</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.05)]">
                    <div class="space-y-2">
                        <div class="flex justify-between gap-x-6">
                            <p class="text-[#617589] text-sm font-normal leading-normal">Location du véhicule (7 jours)</p>
                            <p class="text-[#111418] text-sm font-normal leading-normal text-right">350.00€</p>
                        </div>
                        <div class="flex justify-between gap-x-6">
                            <p class="text-[#617589] text-sm font-normal leading-normal">Options</p>
                            <p class="text-[#111418] text-sm font-normal leading-normal text-right">45.00€</p>
                        </div>
                        <div class="flex justify-between gap-x-6">
                            <p class="text-[#617589] text-sm font-normal leading-normal">Taxes et frais</p>
                            <p class="text-[#111418] text-sm font-normal leading-normal text-right">79.00€</p>
                        </div>
                        <div class="border-t border-gray-200 my-3"></div>
                        <div class="flex justify-between gap-x-6">
                            <p class="text-[#111418] text-base font-bold leading-normal">Total à payer</p>
                            <p class="text-[#111418] text-base font-bold leading-normal text-right">474.00€</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
