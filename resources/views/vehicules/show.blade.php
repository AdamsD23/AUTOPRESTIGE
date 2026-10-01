@extends('layouts.app')

@section('title', $vehicule->nom)
@section('description', $vehicule->description_courte)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
    <nav class="text-sm font-semibold text-slate-400" aria-label="Fil d'Ariane">
        <a href="{{ route('vehicules.index') }}" class="hover:text-navy-700">Nos véhicules</a> /
        <a href="{{ route('vehicules.index', ['categorie' => $vehicule->categorie->slug]) }}" class="hover:text-navy-700">{{ $vehicule->categorie->nom }}</a> /
        <span class="text-navy-900">{{ $vehicule->nom }}</span>
    </nav>

    <div class="mt-6 grid lg:grid-cols-[1fr_400px] gap-10 items-start">
        <div>
            <div class="rounded-[2rem] overflow-hidden bg-slate-100 aspect-[16/10]">
                <img src="{{ $vehicule->image_url }}" alt="{{ $vehicule->nom }}" class="w-full h-full object-cover">
            </div>

            <div class="mt-8">
                <p class="text-sm font-bold uppercase tracking-wider text-gold-600">{{ $vehicule->categorie->nom }} · {{ $vehicule->annee }}</p>
                <h1 class="mt-1 text-4xl font-extrabold text-navy-900">{{ $vehicule->nom }}</h1>
                <p class="mt-3 text-lg text-slate-600">{{ $vehicule->description_courte }}</p>
            </div>

            <div class="mt-8 grid grid-cols-2 sm:grid-cols-4 gap-3">
                @foreach ([
                    ['airline_seat_recline_normal', 'Places', $vehicule->places],
                    ['settings', 'Boîte', \App\Models\Vehicule::BOITES[$vehicule->boite]],
                    ['local_gas_station', 'Énergie', \App\Models\Vehicule::CARBURANTS[$vehicule->carburant]],
                    ['speed', 'Puissance', $vehicule->puissance ?? '—'],
                ] as [$icone, $label, $valeur])
                    <div class="rounded-2xl bg-white border border-slate-200/70 p-4">
                        <span class="material-symbols-outlined text-gold-500">{{ $icone }}</span>
                        <p class="mt-2 text-xs font-bold uppercase tracking-wider text-slate-400">{{ $label }}</p>
                        <p class="font-extrabold text-navy-900">{{ $valeur }}</p>
                    </div>
                @endforeach
            </div>

            @if ($vehicule->equipements)
                <h2 class="mt-10 text-2xl font-extrabold text-navy-900">Équipements</h2>
                <ul class="mt-4 grid sm:grid-cols-2 gap-2">
                    @foreach ($vehicule->equipements as $equipement)
                        <li class="flex items-center gap-2 text-slate-700"><span class="material-symbols-outlined text-emerald-600">check_circle</span>{{ $equipement }}</li>
                    @endforeach
                </ul>
            @endif

            <h2 class="mt-10 text-2xl font-extrabold text-navy-900">Description</h2>
            <p class="mt-3 text-slate-600 leading-relaxed whitespace-pre-line">{{ $vehicule->description }}</p>
        </div>

        {{-- Réservation --}}
        <aside class="lg:sticky lg:top-28 bg-white rounded-[2rem] border border-slate-200/70 shadow-xl shadow-navy-900/5 p-6">
            <p><span class="text-3xl font-extrabold text-navy-900">@fcfa($vehicule->prix_journalier)</span><span class="text-slate-500"> / jour</span></p>
            <p class="mt-1 text-sm text-slate-500">Caution : @fcfa($vehicule->caution) (restituée au retour)</p>

            <form method="GET" action="{{ route('reservations.create', $vehicule) }}" class="mt-6 space-y-3">
                <div class="grid grid-cols-2 gap-3">
                    <label class="block"><span class="block text-sm font-bold mb-1">Départ</span>
                        <input type="date" name="debut" required min="{{ now()->toDateString() }}" value="{{ now()->addDay()->toDateString() }}" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500"></label>
                    <label class="block"><span class="block text-sm font-bold mb-1">Retour</span>
                        <input type="date" name="fin" required min="{{ now()->toDateString() }}" value="{{ now()->addDays(3)->toDateString() }}" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500"></label>
                </div>
                <button class="w-full py-4 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-900 font-extrabold flex items-center justify-center gap-2 transition">
                    <span class="material-symbols-outlined">event_available</span>Réserver ce véhicule
                </button>
                @guest<p class="text-xs text-slate-500 text-center">Vous créerez votre compte gratuit à l'étape suivante.</p>@endguest
            </form>

            @if ($periodesPrises->isNotEmpty())
                <div class="mt-6 rounded-2xl bg-amber-50 p-4 text-sm">
                    <p class="font-bold text-amber-900 flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">event_busy</span>Déjà réservé</p>
                    <ul class="mt-2 space-y-1 text-amber-800">
                        @foreach ($periodesPrises as $periode)
                            <li>du {{ $periode->date_debut->format('d/m') }} au {{ $periode->date_fin->format('d/m/Y') }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <ul class="mt-6 space-y-2 text-sm text-slate-600">
                <li class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-emerald-600">shield</span>Assurance tous risques incluse</li>
                <li class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-emerald-600">person</span>Chauffeur en option (25 000 FCFA / jour)</li>
                <li class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px] text-emerald-600">event_repeat</span>Annulation gratuite avant le départ</li>
            </ul>
        </aside>
    </div>

    @if ($similaires->isNotEmpty())
        <section class="mt-20">
            <h2 class="text-3xl font-extrabold text-navy-900">Vous aimerez aussi</h2>
            <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($similaires as $autre)
                    @include('vehicules._carte', ['vehicule' => $autre->load('categorie')])
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
