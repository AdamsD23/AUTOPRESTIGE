@extends('layouts.app')

@section('title', 'Contact - AutoPrestige Côte d\'Ivoire')

@section('content')
<main class="flex-1 px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    <div class="mx-auto max-w-7xl">
        <!-- PageHeading Component -->
        <div class="mb-12 text-center">
            <h1 class="text-slate-900 text-4xl md:text-5xl font-black leading-tight tracking-[-0.033em]">Contactez-nous, on est là pour vous !</h1>
            <p class="text-slate-600 text-lg font-normal leading-normal mt-4 max-w-2xl mx-auto">Une question ? Un besoin particulier ? Laissez-nous un message, on vous répond au plus vite, c'est promis !</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 xl:gap-16">
            <!-- Left Column: Info Panel -->
            <div class="flex flex-col gap-8">
                <div class="space-y-4">
                    <!-- ListItem: Address -->
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-white">
                        <div class="text-primary flex items-center justify-center rounded-lg bg-primary/10 shrink-0 size-12">
                            <span class="material-symbols-outlined">location_on</span>
                        </div>
                        <div class="flex flex-col justify-center">
                            <p class="text-slate-900 text-base font-semibold leading-normal">Adresse</p>
                            <p class="text-slate-600 text-sm font-normal leading-normal">Riviera 3, Boulevard Latrille, 01 BP 1234 Abidjan 01</p>
                            <a class="text-primary text-sm font-medium mt-2 hover:underline" href="#">Itinéraire</a>
                        </div>
                    </div>

                    <!-- ListItem: Phone -->
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-white">
                        <div class="text-primary flex items-center justify-center rounded-lg bg-primary/10 shrink-0 size-12">
                            <span class="material-symbols-outlined">call</span>
                        </div>
                        <div class="flex flex-col justify-center">
                            <p class="text-slate-900 text-base font-semibold leading-normal">Téléphone</p>
                            <p class="text-slate-600 text-sm font-normal leading-normal">+225 07 07 07 07 07</p>
                            <a class="text-primary text-sm font-medium mt-2 hover:underline" href="tel:+33123456789">Appeler</a>
                        </div>
                    </div>

                    <!-- ListItem: Email -->
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-white">
                        <div class="text-primary flex items-center justify-center rounded-lg bg-primary/10 shrink-0 size-12">
                            <span class="material-symbols-outlined">mail</span>
                        </div>
                        <div class="flex flex-col justify-center">
                            <p class="text-slate-900 text-base font-semibold leading-normal">Email</p>
                            <p class="text-slate-600 text-sm font-normal leading-normal">contact@autoprestige.ci</p>
                            <a class="text-primary text-sm font-medium mt-2 hover:underline" href="mailto:contact@autoprestige.ci">Envoyer un email</a>
                        </div>
                    </div>
                </div>

                <!-- Opening Hours -->
                <div class="p-6 rounded-xl bg-white">
                    <h3 class="text-slate-900 text-lg font-bold mb-4">Horaires d'ouverture</h3>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li class="flex justify-between items-center"><span>Lundi - Vendredi</span><span class="font-medium text-slate-800">8:00 - 19:00</span></li>
                        <li class="flex justify-between items-center"><span>Samedi</span><span class="font-medium text-slate-800">9:00 - 17:00</span></li>
                        <li class="flex justify-between items-center"><span>Dimanche</span><span class="font-medium text-slate-800">Sur RDV</span></li>
                    </ul>
                </div>

                <!-- Map -->
                <div>
                    <img alt="Carte indiquant l'emplacement de l'agence à Abidjan" class=""/>
                </div>
            </div>

            <!-- Right Column: Contact Form -->
            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-sm">
                <h2 class="text-slate-900 text-2xl font-bold mb-6">Laissez-nous un petit mot !</h2>
                <form class="grid grid-cols-1 gap-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5" for="full-name">Nom complet</label>
                            <input class="block w-full rounded-lg border border-slate-300 bg-background-light focus:border-primary focus:ring-primary text-sm px-3 py-2" id="full-name" placeholder="Votre nom complet" type="text"/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5" for="email">Email</label>
                            <input class="block w-full rounded-lg border border-slate-300 bg-background-light focus:border-primary focus:ring-primary text-sm px-3 py-2" id="email" placeholder="votrenom@email.com" type="email"/>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5" for="subject">Objet</label>
                        <select class="block w-full rounded-lg border border-slate-300 bg-background-light focus:border-primary focus:ring-primary text-sm px-3 py-2">
                            <option>Demande d'informations Ventes</option>
                            <option>Question sur la Location</option>
                            <option>Service Après-Vente</option>
                            <option>Autre</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5" for="message">Votre message</label>
                        <textarea class="block w-full rounded-lg border border-slate-300 bg-background-light focus:border-primary focus:ring-primary text-sm px-3 py-2" id="message" placeholder="Bonjour, j'aimerais avoir plus d'infos sur..." rows="5"></textarea>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input class="h-4 w-4 rounded border-slate-300 text-primary focus:ring-primary" id="consent" type="checkbox"/>
                        </div>
                        <div class="ml-3 text-sm">
                            <label class="text-slate-600" for="consent">J'accepte la <a class="font-medium text-primary hover:underline" href="#">politique de confidentialité</a>.</label>
                        </div>
                    </div>

                    <div>
                        <button class="w-full flex items-center justify-center rounded-lg bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors" type="submit">Envoyer mon message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
