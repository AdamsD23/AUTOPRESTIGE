@extends('layouts.app')

@section('title', 'AutoPrestige')

@section('content')
    {{-- Hero --}}
    <section class="relative bg-navy-950 text-white overflow-hidden">
        <img src="{{ asset('images/vehicules/hero-garage.jpg') }}" alt="" class="absolute inset-0 w-full h-full object-cover opacity-50">
        <div class="absolute inset-0 bg-gradient-to-r from-navy-950 via-navy-950/80 to-transparent"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-36 lg:pt-28 lg:pb-44">
            <p class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 text-gold-300 text-sm font-bold">
                <span class="material-symbols-outlined text-[18px]">verified</span>Véhicules assurés tous risques
            </p>
            <h1 class="mt-6 text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.05] max-w-2xl">Louez le véhicule de vos rêves à <span class="text-gold-400">Abidjan</span>.</h1>
            <p class="mt-6 text-lg text-white/70 max-w-xl">SUV, berlines, sportives ou électriques, avec ou sans chauffeur. Livraison à l'aéroport ou à domicile, paiement Wave et Orange Money.</p>
        </div>
    </section>

    {{-- Recherche par dates --}}
    <section class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24">
        <form action="{{ route('vehicules.index') }}" method="GET" class="bg-white rounded-3xl shadow-2xl shadow-navy-900/10 p-5 sm:p-6 grid gap-4 md:grid-cols-[1fr_1fr_1fr_auto] items-end">
            <label class="block">
                <span class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Catégorie</span>
                <select name="categorie" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500">
                    <option value="">Toutes</option>
                    @foreach ($categories as $categorie)<option value="{{ $categorie->slug }}">{{ $categorie->nom }}</option>@endforeach
                </select>
            </label>
            <label class="block">
                <span class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Départ</span>
                <input type="date" name="debut" min="{{ now()->toDateString() }}" value="{{ now()->addDay()->toDateString() }}" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500">
            </label>
            <label class="block">
                <span class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">Retour</span>
                <input type="date" name="fin" min="{{ now()->toDateString() }}" value="{{ now()->addDays(3)->toDateString() }}" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500">
            </label>
            <button class="h-[42px] px-6 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-900 font-extrabold flex items-center justify-center gap-2 transition">
                <span class="material-symbols-outlined">search</span>Voir les disponibilités
            </button>
        </form>
        <div class="mt-6 grid grid-cols-3 gap-4 text-center">
            <div><p class="text-3xl font-extrabold text-navy-900">{{ $nombreVehicules }}</p><p class="text-sm text-slate-500">véhicules disponibles</p></div>
            <div><p class="text-3xl font-extrabold text-navy-900">dès {{ number_format($prixMinimum, 0, ',', ' ') }}</p><p class="text-sm text-slate-500">FCFA par jour</p></div>
            <div><p class="text-3xl font-extrabold text-navy-900">7j/7</p><p class="text-sm text-slate-500">de 7h à 21h</p></div>
        </div>
    </section>

    {{-- Catégories --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
        <h2 class="text-3xl font-extrabold text-navy-900">Explorer par catégorie</h2>
        <div class="mt-8 grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach ($categories as $categorie)
                <a href="{{ route('vehicules.index', ['categorie' => $categorie->slug]) }}" class="group rounded-3xl bg-white border border-slate-200/70 p-5 hover:border-gold-500 hover:shadow-lg transition">
                    <span class="w-12 h-12 rounded-2xl bg-navy-50 text-navy-700 group-hover:bg-gold-500 group-hover:text-navy-900 flex items-center justify-center transition"><span class="material-symbols-outlined">{{ $categorie->icone }}</span></span>
                    <p class="mt-4 font-extrabold text-navy-900">{{ $categorie->nom }}</p>
                    <p class="text-sm text-slate-500">{{ $categorie->vehicules_count }} véhicule(s)</p>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Véhicules populaires --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <h2 class="text-3xl font-extrabold text-navy-900">Les plus demandés</h2>
            <a href="{{ route('vehicules.index') }}" class="inline-flex items-center gap-1 font-bold text-navy-700 hover:text-gold-600">Toute la flotte<span class="material-symbols-outlined">arrow_forward</span></a>
        </div>
        <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($vedettes as $vehicule)
                @include('vehicules._carte', ['vehicule' => $vehicule])
            @endforeach
        </div>
    </section>

    {{-- Comment ça marche --}}
    <section id="comment-ca-marche" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 scroll-mt-24">
        <div class="rounded-[2rem] bg-navy-900 text-white p-8 sm:p-12">
            <h2 class="text-3xl font-extrabold">Comment ça marche ?</h2>
            <div class="mt-10 grid md:grid-cols-4 gap-8">
                @foreach ([
                    ['search', 'Choisissez', 'Filtrez par catégorie, budget et dates : seuls les véhicules libres s\'affichent.'],
                    ['edit_calendar', 'Réservez', 'Dates, chauffeur, lieu de prise en charge : le prix total se calcule en direct.'],
                    ['verified', 'Confirmation', 'Notre équipe confirme votre réservation et vous contacte par téléphone.'],
                    ['key', 'Roulez', 'Récupérez le véhicule à l\'agence, à l\'aéroport ou chez vous. Payez par Wave, Orange Money ou en espèces.'],
                ] as $i => [$icone, $titre, $texte])
                    <div>
                        <span class="w-12 h-12 rounded-2xl bg-gold-500 text-navy-900 flex items-center justify-center font-extrabold">{{ $i + 1 }}</span>
                        <h3 class="mt-4 text-lg font-extrabold flex items-center gap-2"><span class="material-symbols-outlined text-gold-400">{{ $icone }}</span>{{ $titre }}</h3>
                        <p class="mt-2 text-white/60">{{ $texte }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
