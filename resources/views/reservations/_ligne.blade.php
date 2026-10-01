<a href="{{ route('reservations.show', $reservation) }}" class="group flex flex-col sm:flex-row gap-4 bg-white rounded-3xl border border-slate-200/70 p-4 hover:shadow-lg hover:border-gold-500 transition">
    <img src="{{ $reservation->vehicule->image_url }}" alt="" class="sm:w-44 aspect-[16/10] object-cover rounded-2xl">
    <div class="flex-1 min-w-0">
        <div class="flex flex-wrap items-center gap-2">
            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $reservation->statut_couleur }}">{{ $reservation->statut_libelle }}</span>
            <span class="text-xs font-bold text-slate-400 tracking-wider">{{ $reservation->reference }}</span>
        </div>
        <p class="mt-2 text-lg font-extrabold text-navy-900 group-hover:text-gold-600">{{ $reservation->vehicule->nom }}</p>
        <p class="text-sm text-slate-500">Du {{ $reservation->date_debut->translatedFormat('d M') }} au {{ $reservation->date_fin->translatedFormat('d M Y') }} · {{ $reservation->nombre_jours }} jour(s){{ $reservation->avec_chauffeur ? ' · avec chauffeur' : '' }}</p>
    </div>
    <div class="sm:text-right self-center">
        <p class="text-xl font-extrabold text-navy-900">@fcfa($reservation->prix_total)</p>
        <p class="text-sm font-bold text-gold-600 flex items-center sm:justify-end gap-1">Détails<span class="material-symbols-outlined text-[18px]">chevron_right</span></p>
    </div>
</a>
