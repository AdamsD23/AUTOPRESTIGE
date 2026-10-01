<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mon compte | AutoPrestige</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-900 antialiased">
<div class="min-h-screen grid lg:grid-cols-2">
    <div class="hidden lg:block relative">
        <img src="{{ asset('images/vehicules/hero-garage.jpg') }}" alt="" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-navy-900/60 to-navy-900/20"></div>
        <div class="absolute bottom-12 left-12 right-12 text-white">
            <p class="text-4xl font-extrabold leading-tight">Le bon véhicule,<br>au bon moment.</p>
            <p class="mt-3 text-white/70">Réservez en ligne, suivez vos locations et gérez votre profil.</p>
        </div>
    </div>
    <div class="flex flex-col justify-center items-center px-6 py-12 bg-slate-50">
        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-8">
            <x-application-logo class="w-12 h-12" />
            <span class="text-2xl font-extrabold text-navy-900">Auto<span class="text-gold-500">Prestige</span></span>
        </a>
        <div class="w-full sm:max-w-md bg-white rounded-3xl shadow-xl shadow-navy-900/5 px-6 sm:px-8 py-8">
            {{ $slot }}
        </div>
        @if (app()->environment('local', 'production') && (request()->routeIs('login')))
            <p class="mt-6 text-sm text-slate-500 text-center">Démo : <strong>client@demo.ci</strong> / <strong>demo12345</strong></p>
        @endif
    </div>
</div>
</body>
</html>
