@extends('layouts.app')

@section('title', 'Réservation ' . $reservation->reference)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
    <a href="{{ route('reservations.index') }}" class="inline-flex items-center gap-1 font-bold text-slate-500 hover:text-navy-700"><span class="material-symbols-outlined">arrow_back</span>Mes réservations</a>

    <div class="mt-6 bg-white rounded-[2rem] border border-slate-200/70 overflow-hidden">
        <div class="bg-navy-900 text-white p-6 sm:p-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-sm text-white/60">Réservation</p>
                <p class="text-3xl font-extrabold tracking-wider">{{ $reservation->reference }}</p>
            </div>
            <span class="px-4 py-2 rounded-full text-sm font-bold {{ $reservation->statut_couleur }}">{{ $reservation->statut_libelle }}</span>
        </div>

        @if ($reservation->statut === 'en_attente')
            <div class="mx-6 sm:mx-8 mt-6 rounded-2xl bg-amber-50 p-4 text-amber-900 flex gap-3">
                <span class="material-symbols-outlined">schedule</span>
                <p>Votre demande est bien reçue. Un conseiller vous appelle au <strong>{{ $reservation->telephone }}</strong> pour la confirmer, en général dans l'heure (7h – 21h).</p>
            </div>
        @endif

        <div class="p-6 sm:p-8 grid sm:grid-cols-[200px_1fr] gap-6">
            <img src="{{ $reservation->vehicule->image_url }}" alt="" class="w-full aspect-[4/3] object-cover rounded-2xl">
            <div>
                <p class="text-2xl font-extrabold text-navy-900">{{ $reservation->vehicule->nom }}</p>
                <dl class="mt-4 grid sm:grid-cols-2 gap-4 text-sm">
                    <div><dt class="text-slate-400 font-bold uppercase text-xs">Du</dt><dd class="font-semibold">{{ $reservation->date_debut->translatedFormat('l d F Y') }}</dd></div>
                    <div><dt class="text-slate-400 font-bold uppercase text-xs">Au</dt><dd class="font-semibold">{{ $reservation->date_fin->translatedFormat('l d F Y') }}</dd></div>
                    <div><dt class="text-slate-400 font-bold uppercase text-xs">Prise en charge</dt><dd class="font-semibold">{{ \App\Models\Reservation::LIEUX[$reservation->lieu_prise_en_charge] }}@if ($reservation->adresse_livraison)<br><span class="text-slate-500">{{ $reservation->adresse_livraison }}</span>@endif</dd></div>
                    <div><dt class="text-slate-400 font-bold uppercase text-xs">Paiement</dt><dd class="font-semibold">{{ \App\Models\Reservation::PAIEMENTS[$reservation->mode_paiement] }}</dd></div>
                </dl>
            </div>
        </div>

        <div class="mx-6 sm:mx-8 mb-8 rounded-2xl bg-slate-50 p-5">
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between"><dt>{{ $reservation->nombre_jours }} jour(s) × @fcfa($reservation->prix_journalier)</dt><dd>@fcfa($reservation->nombre_jours * $reservation->prix_journalier)</dd></div>
                @if ($reservation->frais_chauffeur)<div class="flex justify-between"><dt>Chauffeur</dt><dd>@fcfa($reservation->frais_chauffeur)</dd></div>@endif
                @if ($reservation->frais_livraison)<div class="flex justify-between"><dt>Livraison</dt><dd>@fcfa($reservation->frais_livraison)</dd></div>@endif
                <div class="flex justify-between pt-3 border-t border-slate-200 text-lg font-extrabold text-navy-900"><dt>Total</dt><dd>@fcfa($reservation->prix_total)</dd></div>
            </dl>
            @if ($reservation->commentaires)<p class="mt-4 text-sm text-slate-600"><strong>Votre commentaire :</strong> {{ $reservation->commentaires }}</p>@endif
        </div>

        <div class="px-6 sm:px-8 pb-8 flex flex-wrap gap-3">
            <a href="https://wa.me/2250767418701?text={{ urlencode('Bonjour AutoPrestige, je vous contacte au sujet de ma réservation ' . $reservation->reference . '.') }}" target="_blank" rel="noopener" class="px-5 py-3 rounded-xl bg-[#25D366] text-white font-bold flex items-center gap-2"><span class="material-symbols-outlined">chat</span>Nous écrire sur WhatsApp</a>
            @if ($reservation->user_id === auth()->id() && $reservation->estAnnulable())
                <form method="POST" action="{{ route('reservations.annuler', $reservation) }}" onsubmit="return confirm('Annuler cette réservation ?')">
                    @csrf @method('PATCH')
                    <button class="px-5 py-3 rounded-xl border border-red-200 text-red-600 font-bold hover:bg-red-50">Annuler la réservation</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
