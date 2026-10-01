@extends('layouts.app')

@section('title', 'Nos véhicules')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
    <h1 class="text-4xl font-extrabold text-navy-900">Nos véhicules</h1>
    <p class="mt-2 text-slate-500">
        @if (! empty($filtres['debut']) && ! empty($filtres['fin']))
            Disponibles du <strong>{{ \Carbon\Carbon::parse($filtres['debut'])->translatedFormat('d M Y') }}</strong> au <strong>{{ \Carbon\Carbon::parse($filtres['fin'])->translatedFormat('d M Y') }}</strong>.
        @else
            Toute notre flotte, entretenue et assurée tous risques.
        @endif
    </p>

    <div class="mt-8 grid lg:grid-cols-[280px_1fr] gap-8 items-start">
        {{-- Filtres --}}
        <form method="GET" x-data class="lg:sticky lg:top-28 bg-white rounded-3xl border border-slate-200/70 p-6 space-y-5" @change="$el.requestSubmit()">
            <div class="flex items-center justify-between">
                <p class="font-extrabold text-navy-900 flex items-center gap-2"><span class="material-symbols-outlined">tune</span>Filtres</p>
                <a href="{{ route('vehicules.index') }}" class="text-sm font-bold text-gold-600 hover:underline">Réinitialiser</a>
            </div>
            <label class="block">
                <span class="block text-sm font-bold mb-1">Recherche</span>
                <input type="search" name="q" value="{{ $filtres['q'] ?? '' }}" placeholder="Marque, modèle…" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500">
            </label>
            <div class="grid grid-cols-2 gap-3">
                <label class="block"><span class="block text-sm font-bold mb-1">Départ</span>
                    <input type="date" name="debut" min="{{ now()->toDateString() }}" value="{{ $filtres['debut'] ?? '' }}" class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-500 focus:ring-gold-500"></label>
                <label class="block"><span class="block text-sm font-bold mb-1">Retour</span>
                    <input type="date" name="fin" min="{{ now()->toDateString() }}" value="{{ $filtres['fin'] ?? '' }}" class="w-full rounded-xl border-slate-200 text-sm focus:border-gold-500 focus:ring-gold-500"></label>
            </div>
            <label class="block">
                <span class="block text-sm font-bold mb-1">Catégorie</span>
                <select name="categorie" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500">
                    <option value="">Toutes</option>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->slug }}" @selected(($filtres['categorie'] ?? '') === $categorie->slug)>{{ $categorie->nom }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block">
                <span class="block text-sm font-bold mb-1">Budget maximum / jour</span>
                <select name="prix_max" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500">
                    <option value="">Peu importe</option>
                    @foreach ([50000, 100000, 150000] as $max)
                        <option value="{{ $max }}" @selected(($filtres['prix_max'] ?? null) == $max)>{{ number_format($max, 0, ',', ' ') }} FCFA</option>
                    @endforeach
                </select>
            </label>
            <label class="block">
                <span class="block text-sm font-bold mb-1">Boîte de vitesses</span>
                <select name="boite" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500">
                    <option value="">Toutes</option>
                    @foreach (\App\Models\Vehicule::BOITES as $valeur => $libelle)<option value="{{ $valeur }}" @selected(($filtres['boite'] ?? '') === $valeur)>{{ $libelle }}</option>@endforeach
                </select>
            </label>
            <label class="block">
                <span class="block text-sm font-bold mb-1">Énergie</span>
                <select name="carburant" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500">
                    <option value="">Toutes</option>
                    @foreach (\App\Models\Vehicule::CARBURANTS as $valeur => $libelle)<option value="{{ $valeur }}" @selected(($filtres['carburant'] ?? '') === $valeur)>{{ $libelle }}</option>@endforeach
                </select>
            </label>
            <label class="block">
                <span class="block text-sm font-bold mb-1">Places minimum</span>
                <select name="places" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500">
                    <option value="">Peu importe</option>
                    @foreach ([2, 4, 5, 7] as $n)<option value="{{ $n }}" @selected(($filtres['places'] ?? null) == $n)>{{ $n }}+</option>@endforeach
                </select>
            </label>
            <noscript><button class="w-full py-3 rounded-xl bg-navy-900 text-white font-bold">Filtrer</button></noscript>
        </form>

        {{-- Résultats --}}
        <div>
            <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                <p class="font-bold text-slate-600">{{ $vehicules->total() }} véhicule{{ $vehicules->total() > 1 ? 's' : '' }}</p>
                <form method="GET" x-data @change="$el.requestSubmit()">
                    @foreach (collect($filtres)->except('tri')->filter() as $cle => $valeur)<input type="hidden" name="{{ $cle }}" value="{{ $valeur }}">@endforeach
                    <select name="tri" class="rounded-xl border-slate-200 text-sm font-semibold focus:border-gold-500 focus:ring-gold-500" aria-label="Trier">
                        <option value="">Recommandés</option>
                        <option value="prix_asc" @selected(($filtres['tri'] ?? '') === 'prix_asc')>Prix croissant</option>
                        <option value="prix_desc" @selected(($filtres['tri'] ?? '') === 'prix_desc')>Prix décroissant</option>
                        <option value="populaire" @selected(($filtres['tri'] ?? '') === 'populaire')>Les plus loués</option>
                    </select>
                </form>
            </div>

            @if ($vehicules->isEmpty())
                <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-300">
                    <span class="material-symbols-outlined text-5xl text-slate-300">no_crash</span>
                    <p class="mt-3 font-bold text-slate-500">Aucun véhicule ne correspond. Essayez d'autres dates ou d'élargir vos filtres.</p>
                </div>
            @else
                <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ($vehicules as $vehicule)
                        @include('vehicules._carte', ['vehicule' => $vehicule])
                    @endforeach
                </div>
                <div class="mt-10">{{ $vehicules->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
