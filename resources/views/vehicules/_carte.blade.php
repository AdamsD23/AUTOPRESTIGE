{{-- Carte d'un véhicule (catalogue, accueil, suggestions) --}}
<article class="group bg-white rounded-3xl overflow-hidden border border-slate-200/70 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col">
    <a href="{{ route('vehicules.show', $vehicule) }}" class="relative block aspect-[16/10] overflow-hidden bg-slate-100">
        <img src="{{ $vehicule->image_url }}" alt="{{ $vehicule->nom }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-white/90 text-xs font-bold text-navy-800">{{ $vehicule->categorie->nom }}</span>
        @if ($vehicule->est_en_vedette)
            <span class="absolute top-4 right-4 px-3 py-1 rounded-full bg-gold-500 text-xs font-bold text-navy-900">Populaire</span>
        @endif
    </a>
    <div class="p-6 flex flex-col flex-1">
        <h3 class="text-lg font-extrabold text-navy-900"><a href="{{ route('vehicules.show', $vehicule) }}" class="hover:text-gold-600">{{ $vehicule->nom }}</a></h3>
        <p class="text-sm text-slate-500">{{ $vehicule->annee }} · {{ \App\Models\Vehicule::CARBURANTS[$vehicule->carburant] }}</p>
        <div class="mt-4 flex flex-wrap gap-x-4 gap-y-2 text-sm text-slate-600">
            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px] text-slate-400">airline_seat_recline_normal</span>{{ $vehicule->places }} places</span>
            <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px] text-slate-400">settings</span>{{ \App\Models\Vehicule::BOITES[$vehicule->boite] }}</span>
            @if ($vehicule->puissance)<span class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px] text-slate-400">speed</span>{{ $vehicule->puissance }}</span>@endif
        </div>
        <div class="mt-auto pt-5 flex items-end justify-between gap-3">
            <p><span class="text-2xl font-extrabold text-navy-900">@fcfa($vehicule->prix_journalier)</span><span class="text-sm text-slate-500"> / jour</span></p>
            <a href="{{ route('vehicules.show', $vehicule) }}" class="w-11 h-11 rounded-xl bg-navy-900 group-hover:bg-gold-500 text-white group-hover:text-navy-900 flex items-center justify-center transition" aria-label="Voir {{ $vehicule->nom }}">
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
    </div>
</article>
