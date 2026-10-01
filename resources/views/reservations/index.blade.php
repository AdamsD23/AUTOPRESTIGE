@extends('layouts.app')

@section('title', 'Mes réservations')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="font-bold text-gold-600">Bonjour {{ auth()->user()->prenom }}</p>
            <h1 class="text-4xl font-extrabold text-navy-900">Mes réservations</h1>
        </div>
        <a href="{{ route('vehicules.index') }}" class="px-5 py-3 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-900 font-extrabold flex items-center gap-2"><span class="material-symbols-outlined">add</span>Nouvelle location</a>
    </div>

    <h2 class="mt-10 text-xl font-extrabold text-navy-900">À venir et en cours</h2>
    <div class="mt-4 grid gap-4">
        @forelse ($aVenir as $reservation)
            @include('reservations._ligne', ['reservation' => $reservation])
        @empty
            <div class="rounded-3xl bg-white border border-dashed border-slate-300 p-10 text-center">
                <span class="material-symbols-outlined text-5xl text-slate-300">directions_car</span>
                <p class="mt-2 font-bold text-slate-500">Aucune location prévue.</p>
                <a href="{{ route('vehicules.index') }}" class="inline-block mt-4 font-bold text-gold-600 hover:underline">Choisir un véhicule</a>
            </div>
        @endforelse
    </div>

    @if ($historique->isNotEmpty())
        <h2 class="mt-12 text-xl font-extrabold text-navy-900">Historique</h2>
        <div class="mt-4 grid gap-4">
            @foreach ($historique as $reservation)
                @include('reservations._ligne', ['reservation' => $reservation])
            @endforeach
        </div>
    @endif
</div>
@endsection
