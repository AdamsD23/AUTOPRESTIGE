@extends('layouts.app')

@section('title', 'Mon Compte - AutoPrestige Côte d\'Ivoire')

@section('content')
<main class="flex-grow bg-gray-50 py-12 md:py-16">
    <div class="container mx-auto px-4">
        <header class="mb-8 md:mb-12">
            <h1 class="text-3xl font-bold text-gray-900 md:text-4xl">Mon Compte</h1>
            <p class="mt-2 text-lg text-gray-600">Bienvenue sur votre espace personnel - Akwaba !</p>
        </header>
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-12">
            <aside class="lg:col-span-3">
                <nav class="sticky top-28 flex flex-col space-y-2">
                    <a class="group flex items-center gap-3 rounded-lg bg-primary/10 px-4 py-3 text-primary" href="#profile">
                        <span class="material-symbols-outlined">person</span>
                        <span class="text-sm font-semibold">Mes informations</span>
                    </a>
                    <a class="group flex items-center gap-3 rounded-lg px-4 py-3 text-gray-600 hover:bg-gray-100" href="#ads">
                        <span class="material-symbols-outlined">directions_car</span>
                        <span class="text-sm font-semibold">Mes véhicules</span>
                    </a>
                    <a class="group flex items-center gap-3 rounded-lg px-4 py-3 text-gray-600 hover:bg-gray-100" href="#favorites">
                        <span class="material-symbols-outlined">favorite</span>
                        <span class="text-sm font-semibold">Mes favoris</span>
                    </a>
                    <a class="group flex items-center gap-3 rounded-lg px-4 py-3 text-gray-600 hover:bg-gray-100" href="#history">
                        <span class="material-symbols-outlined">history</span>
                        <span class="text-sm font-semibold">Historique</span>
                    </a>
                    <a class="group flex items-center gap-3 rounded-lg px-4 py-3 text-gray-600 hover:bg-gray-100" href="#settings">
                        <span class="material-symbols-outlined">settings</span>
                        <span class="text-sm font-semibold">Paramètres</span>
                    </a>
                    <a class="group flex items-center gap-3 rounded-lg px-4 py-3 text-red-500 hover:bg-red-50" href="#logout">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="text-sm font-semibold">Déconnexion</span>
                    </a>
                </nav>
            </aside>
            <div class="lg:col-span-9">
                <div class="divide-y divide-gray-200 rounded-xl bg-white shadow-lg">
                    <div id="profile" class="p-6 md:p-8">
                        <div class="w-full">
                            <h2 class="text-2xl font-bold text-gray-900">Adams Kouamé</h2>
                            <p class="text-gray-500">Membre depuis Janvier 2025 • Abidjan, Côte d'Ivoire</p>
                        </div>
                    </div>
                    <div class="p-6 md:p-8">
                        <h3 class="text-lg font-semibold text-gray-900">Vos informations</h3>
                        <form class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="nom">Nom</label>
                                <input class="form-input mt-1 flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-gray-100 border-transparent focus:border-primary focus:ring-primary/50 focus:ring-2 h-11 placeholder:text-gray-500 px-4 text-base font-normal leading-normal" id="nom" type="text" value="Dupont"/>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="prenom">Prénom</label>
                                <input class="form-input mt-1 flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-gray-100 border-transparent focus:border-primary focus:ring-primary/50 focus:ring-2 h-11 placeholder:text-gray-500 px-4 text-base font-normal leading-normal" id="prenom" type="text" value="Jean"/>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700" for="email">Adresse e-mail</label>
                                <input class="form-input mt-1 flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-gray-100 border-transparent focus:border-primary focus:ring-primary/50 focus:ring-2 h-11 placeholder:text-gray-500 px-4 text-base font-normal leading-normal" id="email" type="email" value="jean.dupont@email.com"/>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="telephone">Téléphone (Côte d'Ivoire)</label>
                                <div class="mt-1 flex rounded-lg shadow-sm">
                                    <span class="inline-flex items-center rounded-l-lg border border-r-0 border-gray-300 bg-gray-100 px-3 text-gray-700 text-sm">+225</span>
                                    <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg bg-gray-100 border-transparent focus:border-primary focus:ring-primary/50 focus:ring-2 h-11 placeholder:text-gray-500 px-4 text-base font-normal leading-normal" id="telephone" type="tel" placeholder="07 49 85 63 21" value="07 49 85 63 21"/>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700" for="motdepasse">Mot de passe</label>
                                <button class="mt-1 flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-4 bg-gray-100 text-gray-700 text-sm font-bold shadow-sm transition-colors hover:bg-gray-200">
                                    <span class="truncate">Changer le mot de passe</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="flex justify-between items-center p-6 border-t border-gray-200">
                        <div class="text-sm text-gray-500">
                            <span class="material-symbols-outlined align-middle text-base mr-1">info</span>
                            Service client : <span class="font-medium">+225 27 20 21 22 23</span>
                        </div>
                        <button class="flex min-w-[120px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-11 px-6 bg-primary hover:bg-primary/90 text-white text-base font-bold shadow-sm transition-all duration-300 transform hover:scale-105">
                            <span class="material-symbols-outlined text-lg mr-1">save</span>
                            <span class="truncate">Enregistrer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
