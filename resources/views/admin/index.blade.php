@extends('layouts.app')

@section('title', 'Administration')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10" x-data="{ onglet: 'reservations' }">
    <p class="font-bold text-gold-600">Administration</p>
    <h1 class="text-4xl font-extrabold text-navy-900">Tableau de bord</h1>

    <div class="mt-8 grid grid-cols-2 lg:grid-cols-5 gap-4">
        @foreach ([
            ['pending_actions', 'À confirmer', $stats['en_attente']],
            ['event_available', 'Confirmées', $stats['confirmees']],
            ['payments', 'Chiffre d\'affaires', number_format($stats['chiffre_affaires'], 0, ',', ' ') . ' FCFA'],
            ['group', 'Clients', $stats['clients']],
            ['mail', 'Messages non lus', $stats['messages']],
        ] as [$icone, $label, $valeur])
            <div class="bg-white rounded-3xl border border-slate-200/70 p-5">
                <span class="material-symbols-outlined text-gold-500">{{ $icone }}</span>
                <p class="mt-2 text-2xl font-extrabold text-navy-900">{{ $valeur }}</p>
                <p class="text-sm text-slate-500">{{ $label }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-10 flex gap-2 border-b border-slate-200 overflow-x-auto">
        @foreach (['reservations' => 'Réservations', 'vehicules' => 'Véhicules', 'messages' => 'Messages'] as $cle => $label)
            <button type="button" @click="onglet = '{{ $cle }}'" class="px-5 py-3 font-bold border-b-2 -mb-px whitespace-nowrap" :class="onglet === '{{ $cle }}' ? 'border-gold-500 text-navy-900' : 'border-transparent text-slate-400'">{{ $label }}</button>
        @endforeach
    </div>

    {{-- Réservations --}}
    <section x-show="onglet === 'reservations'" class="mt-6">
        <div class="flex flex-wrap gap-2 mb-4 text-sm">
            <a href="{{ route('admin.index') }}" class="px-4 py-2 rounded-full font-bold {{ ! $statut ? 'bg-navy-900 text-white' : 'bg-white border border-slate-200' }}">Toutes</a>
            @foreach (\App\Models\Reservation::STATUTS as $cle => $label)
                <a href="{{ route('admin.index', ['statut' => $cle]) }}" class="px-4 py-2 rounded-full font-bold {{ $statut === $cle ? 'bg-navy-900 text-white' : 'bg-white border border-slate-200' }}">{{ $label }}</a>
            @endforeach
        </div>
        <div class="bg-white rounded-3xl border border-slate-200/70 overflow-x-auto">
            <table class="w-full text-sm min-w-[860px]">
                <thead class="bg-slate-50 text-left text-slate-500">
                    <tr><th class="px-4 py-3">Référence</th><th class="px-4 py-3">Client</th><th class="px-4 py-3">Véhicule</th><th class="px-4 py-3">Période</th><th class="px-4 py-3 text-right">Total</th><th class="px-4 py-3">Statut</th><th class="px-4 py-3"></th></tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($reservations as $r)
                        <tr>
                            <td class="px-4 py-3 font-bold"><a href="{{ route('reservations.show', $r) }}" class="hover:text-gold-600">{{ $r->reference }}</a></td>
                            <td class="px-4 py-3">{{ $r->user->nom_complet }}<br><a href="tel:{{ $r->telephone }}" class="text-slate-500">{{ $r->telephone }}</a></td>
                            <td class="px-4 py-3">{{ $r->vehicule->nom }}{{ $r->avec_chauffeur ? ' (chauffeur)' : '' }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ $r->date_debut->format('d/m') }} → {{ $r->date_fin->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-right font-bold whitespace-nowrap">@fcfa($r->prix_total)</td>
                            <td class="px-4 py-3"><span class="px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap {{ $r->statut_couleur }}">{{ $r->statut_libelle }}</span></td>
                            <td class="px-4 py-3">
                                <div class="flex gap-1 justify-end">
                                    @if ($r->statut === 'en_attente')
                                        @foreach (['confirmee' => ['Confirmer', 'bg-emerald-600 text-white'], 'refusee' => ['Refuser', 'bg-red-50 text-red-700']] as $nouveau => [$texte, $classes])
                                            <form method="POST" action="{{ route('admin.reservations.statut', $r) }}">@csrf @method('PATCH')
                                                <input type="hidden" name="statut" value="{{ $nouveau }}">
                                                <button class="px-3 py-1.5 rounded-lg font-bold {{ $classes }}">{{ $texte }}</button>
                                            </form>
                                        @endforeach
                                    @elseif ($r->statut === 'confirmee')
                                        <form method="POST" action="{{ route('admin.reservations.statut', $r) }}">@csrf @method('PATCH')
                                            <input type="hidden" name="statut" value="terminee">
                                            <button class="px-3 py-1.5 rounded-lg font-bold bg-slate-100">Marquer terminée</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-4 py-10 text-center text-slate-500">Aucune réservation.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- Véhicules --}}
    <section x-show="onglet === 'vehicules'" x-cloak class="mt-6 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($vehicules as $v)
            <div class="bg-white rounded-3xl border border-slate-200/70 p-4 flex gap-4 items-center {{ $v->est_disponible ? '' : 'opacity-60' }}">
                <img src="{{ $v->image_url }}" alt="" class="w-24 aspect-[4/3] object-cover rounded-xl">
                <div class="flex-1 min-w-0">
                    <p class="font-extrabold text-navy-900 truncate">{{ $v->nom }}</p>
                    <p class="text-sm text-slate-500">@fcfa($v->prix_journalier) / jour · {{ $v->nombre_locations }} locations</p>
                    <form method="POST" action="{{ route('admin.vehicules.disponibilite', $v) }}" class="mt-2">@csrf @method('PATCH')
                        <button class="text-sm font-bold {{ $v->est_disponible ? 'text-red-600' : 'text-emerald-700' }}">{{ $v->est_disponible ? 'Retirer du catalogue' : 'Remettre au catalogue' }}</button>
                    </form>
                </div>
            </div>
        @endforeach
    </section>

    {{-- Messages --}}
    <section x-show="onglet === 'messages'" x-cloak class="mt-6 grid gap-4">
        @forelse ($messages as $m)
            <article class="bg-white rounded-3xl border p-5 {{ $m->est_lu ? 'border-slate-200/70' : 'border-gold-500' }}">
                <div class="flex flex-wrap justify-between gap-2">
                    <p class="font-extrabold text-navy-900">{{ $m->sujet }}</p>
                    <p class="text-sm text-slate-400">{{ $m->created_at->diffForHumans() }}</p>
                </div>
                <p class="text-sm text-slate-500">{{ $m->nom }} · <a href="mailto:{{ $m->email }}" class="hover:text-gold-600">{{ $m->email }}</a>{{ $m->telephone ? ' · ' . $m->telephone : '' }}</p>
                <p class="mt-3 text-slate-700 whitespace-pre-line">{{ $m->message }}</p>
                @unless ($m->est_lu)
                    <form method="POST" action="{{ route('admin.messages.lu', $m) }}" class="mt-3">@csrf @method('PATCH')
                        <button class="text-sm font-bold text-gold-600">Marquer comme lu</button>
                    </form>
                @endunless
            </article>
        @empty
            <p class="text-slate-500">Aucun message.</p>
        @endforelse
    </section>
</div>
@endsection
