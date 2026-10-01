@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 grid lg:grid-cols-[1fr_1.3fr] gap-10 items-start">
    <div>
        <h1 class="text-4xl font-extrabold text-navy-900">Contactez-nous</h1>
        <p class="mt-3 text-slate-600">Mariage, déplacement professionnel, location longue durée : dites-nous ce dont vous avez besoin, nous vous répondons rapidement.</p>
        <ul class="mt-8 space-y-4">
            <li class="flex gap-3"><span class="material-symbols-outlined text-gold-500">location_on</span><span><strong class="block text-navy-900">Agence</strong>Cocody Riviera 3, Abidjan</span></li>
            <li class="flex gap-3"><span class="material-symbols-outlined text-gold-500">schedule</span><span><strong class="block text-navy-900">Horaires</strong>Tous les jours, 7h – 21h</span></li>
            <li class="flex gap-3"><span class="material-symbols-outlined text-gold-500">call</span><span><strong class="block text-navy-900">Téléphone</strong><a href="tel:+2250767418701" class="hover:text-gold-600">+225 07 67 41 87 01</a></span></li>
        </ul>
        <a href="https://wa.me/2250767418701" target="_blank" rel="noopener" class="inline-flex items-center gap-2 mt-8 px-5 py-3 rounded-xl bg-[#25D366] text-white font-bold"><span class="material-symbols-outlined">chat</span>Écrire sur WhatsApp</a>
    </div>

    <form method="POST" action="{{ route('contact.store') }}" class="bg-white rounded-[2rem] border border-slate-200/70 shadow-xl shadow-navy-900/5 p-6 sm:p-8 grid sm:grid-cols-2 gap-4">
        @csrf
        <label class="block"><span class="block text-sm font-bold mb-1">Nom complet *</span>
            <input name="nom" value="{{ old('nom', auth()->user()?->nom_complet) }}" required maxlength="150" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500">
            @error('nom')<span class="text-sm text-red-600">{{ $message }}</span>@enderror</label>
        <label class="block"><span class="block text-sm font-bold mb-1">Email *</span>
            <input type="email" name="email" value="{{ old('email', auth()->user()?->email) }}" required class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500">
            @error('email')<span class="text-sm text-red-600">{{ $message }}</span>@enderror</label>
        <label class="block"><span class="block text-sm font-bold mb-1">Téléphone</span>
            <input type="tel" name="telephone" value="{{ old('telephone', auth()->user()?->telephone) }}" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500"></label>
        <label class="block"><span class="block text-sm font-bold mb-1">Sujet *</span>
            <input name="sujet" value="{{ old('sujet') }}" required maxlength="150" placeholder="Ex : location pour un mariage" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500">
            @error('sujet')<span class="text-sm text-red-600">{{ $message }}</span>@enderror</label>
        <label class="block sm:col-span-2"><span class="block text-sm font-bold mb-1">Message *</span>
            <textarea name="message" rows="5" required minlength="10" maxlength="3000" class="w-full rounded-xl border-slate-200 focus:border-gold-500 focus:ring-gold-500">{{ old('message') }}</textarea>
            @error('message')<span class="text-sm text-red-600">{{ $message }}</span>@enderror</label>
        <button class="sm:col-span-2 py-4 rounded-xl bg-navy-900 hover:bg-navy-800 text-white font-extrabold transition">Envoyer le message</button>
    </form>
</div>
@endsection
