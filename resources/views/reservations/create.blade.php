@extends('layouts.app')

@section('title', 'Réserver ' . $vehicule->nom)

@php
    $tarifs = [
        'jour' => $vehicule->prix_journalier,
        'chauffeur' => \App\Models\Reservation::FRAIS_CHAUFFEUR_PAR_JOUR,
        'livraison' => \App\Models\Reservation::FRAIS_LIVRAISON,
    ];
@endphp

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10"
     x-data="reservation(@js($tarifs), @js(old('date_debut', $debut)), @js(old('date_fin', $fin)), @js(old('lieu_prise_en_charge', 'agence')), @js((bool) old('avec_chauffeur')))">
    <a href="{{ route('vehicules.show', $vehicule) }}" class="inline-flex items-center gap-1 font-bold text-slate-500 hover:text-navy-700"><span class="material-symbols-outlined">arrow_back</span>{{ $vehicule->nom }}</a>
    <h1 class="mt-4 text-4xl font-extrabold text-navy-900">Réserver</h1>

    <div class="mt-8 grid lg:grid-cols-[1fr_380px] gap-8 items-start">
        <form method="POST" action="{{ route('reservations.store', $vehicule) }}" class="space-y-6">
            @csrf

            @if ($errors->any())
                <div class="rounded-2xl bg-red-50 border border-red-200 p-4 text-red-700">
                    <p class="font-bold">Merci de corriger :</p>
                    <ul class="mt-1 list-disc list-inside">@foreach ($errors->all() as $erreur)<li>{{ $erreur }}</li>@endforeach</ul>
                </div>
            @endif

            <section class="bg-white rounded-3xl border border-slate-200/70 p-6">
                <h2 class="text-lg font-extrabold text-navy-900">1. Dates de location</h2>
                <div class="mt-4 grid sm:grid-cols-2 gap-4">
                    <label class="block"><span class="block text-sm font-bold mb-1">Départ</span>
                        <input type="date" name="date_debut" x-model="debut" required min="{{ now()->toDateString() }}" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500"></label>
                    <label class="block"><span class="block text-sm font-bold mb-1">Retour</span>
                        <input type="date" name="date_fin" x-model="fin" required :min="debut" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500"></label>
                </div>
                <p class="mt-3 text-sm text-slate-500">Le jour du départ et celui du retour sont comptés.</p>
            </section>

            <section class="bg-white rounded-3xl border border-slate-200/70 p-6">
                <h2 class="text-lg font-extrabold text-navy-900">2. Prise en charge</h2>
                <div class="mt-4 grid gap-3">
                    @foreach (\App\Models\Reservation::LIEUX as $valeur => $libelle)
                        <label class="flex items-center gap-3 p-4 rounded-2xl border border-slate-200 cursor-pointer transition has-[:checked]:border-gold-500 has-[:checked]:bg-gold-500/5">
                            <input type="radio" name="lieu_prise_en_charge" value="{{ $valeur }}" x-model="lieu" class="text-gold-500 focus:ring-gold-500">
                            <span class="flex-1 font-semibold">{{ $libelle }}</span>
                            <span class="text-sm text-slate-500">{{ \App\Models\Reservation::FRAIS_LIVRAISON[$valeur] ? '+ ' . number_format(\App\Models\Reservation::FRAIS_LIVRAISON[$valeur], 0, ',', ' ') . ' FCFA' : 'Gratuit' }}</span>
                        </label>
                    @endforeach
                </div>
                <label x-show="lieu === 'domicile'" x-transition class="block mt-4"><span class="block text-sm font-bold mb-1">Adresse de livraison</span>
                    <input type="text" name="adresse_livraison" value="{{ old('adresse_livraison') }}" maxlength="255" placeholder="Commune, quartier, repère" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500"></label>

                <label class="mt-5 flex items-center gap-3 p-4 rounded-2xl border border-slate-200 cursor-pointer transition has-[:checked]:border-gold-500 has-[:checked]:bg-gold-500/5">
                    <input type="checkbox" name="avec_chauffeur" value="1" x-model="chauffeur" class="rounded text-gold-500 focus:ring-gold-500">
                    <span class="flex-1"><span class="block font-semibold">Avec chauffeur</span><span class="text-sm text-slate-500">Chauffeur professionnel, carburant non inclus</span></span>
                    <span class="text-sm text-slate-500">+ 25 000 FCFA / jour</span>
                </label>
            </section>

            <section class="bg-white rounded-3xl border border-slate-200/70 p-6">
                <h2 class="text-lg font-extrabold text-navy-900">3. Contact et paiement</h2>
                <label class="block mt-4"><span class="block text-sm font-bold mb-1">Téléphone (pour la confirmation)</span>
                    <input type="tel" name="telephone" value="{{ old('telephone', auth()->user()->telephone) }}" required class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500"></label>
                <p class="mt-4 text-sm font-bold">Mode de paiement</p>
                <div class="mt-2 grid sm:grid-cols-3 gap-3">
                    @foreach (\App\Models\Reservation::PAIEMENTS as $valeur => $libelle)
                        <label class="flex items-center gap-2 p-3 rounded-xl border border-slate-200 cursor-pointer has-[:checked]:border-gold-500 has-[:checked]:bg-gold-500/5">
                            <input type="radio" name="mode_paiement" value="{{ $valeur }}" @checked(old('mode_paiement', 'wave') === $valeur) class="text-gold-500 focus:ring-gold-500">
                            <span class="text-sm font-semibold">{{ $libelle }}</span>
                        </label>
                    @endforeach
                </div>
                <label class="block mt-4"><span class="block text-sm font-bold mb-1">Commentaire (facultatif)</span>
                    <textarea name="commentaires" rows="3" maxlength="1000" placeholder="Heure souhaitée, siège bébé…" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500">{{ old('commentaires') }}</textarea></label>
            </section>

            <button class="w-full py-4 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-900 text-lg font-extrabold transition" :disabled="jours < 1" :class="jours < 1 && 'opacity-50'">
                Confirmer ma demande · <span x-text="format(total)"></span>
            </button>
            <p class="text-sm text-slate-500 text-center">Aucun paiement maintenant : nous vous appelons pour confirmer.</p>
        </form>

        {{-- Récapitulatif --}}
        <aside class="lg:sticky lg:top-28 bg-navy-900 text-white rounded-3xl overflow-hidden">
            <img src="{{ $vehicule->image_url }}" alt="" class="w-full aspect-[16/10] object-cover">
            <div class="p-6">
                <p class="text-xl font-extrabold">{{ $vehicule->nom }}</p>
                <dl class="mt-5 space-y-3 text-sm">
                    <div class="flex justify-between"><dt class="text-white/60"><span x-text="jours"></span> jour(s) × @fcfa($vehicule->prix_journalier)</dt><dd x-text="format(jours * tarifs.jour)"></dd></div>
                    <div class="flex justify-between" x-show="chauffeur"><dt class="text-white/60">Chauffeur</dt><dd x-text="format(fraisChauffeur)"></dd></div>
                    <div class="flex justify-between" x-show="fraisLivraison > 0"><dt class="text-white/60">Livraison</dt><dd x-text="format(fraisLivraison)"></dd></div>
                    <div class="flex justify-between pt-3 border-t border-white/10 text-lg font-extrabold"><dt>Total</dt><dd class="text-gold-400" x-text="format(total)"></dd></div>
                </dl>
                <p class="mt-4 text-xs text-white/50">Caution de @fcfa($vehicule->caution) demandée à la remise du véhicule, restituée au retour.</p>
            </div>
        </aside>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Calcul du prix en direct (le serveur recalcule toujours le montant final)
    function reservation(tarifs, debut, fin, lieu, chauffeur) {
        return {
            tarifs, debut, fin, lieu, chauffeur,
            get jours() {
                const d = new Date(this.debut), f = new Date(this.fin);
                return isNaN(d) || isNaN(f) || f < d ? 0 : Math.round((f - d) / 86400000) + 1;
            },
            get fraisChauffeur() { return this.chauffeur ? this.tarifs.chauffeur * this.jours : 0; },
            get fraisLivraison() { return this.tarifs.livraison[this.lieu] || 0; },
            get total() { return this.jours * this.tarifs.jour + this.fraisChauffeur + this.fraisLivraison; },
            format(n) { return new Intl.NumberFormat('fr-FR').format(n).replace(/ /g, ' ') + ' FCFA'; }
        };
    }
</script>
@endpush
