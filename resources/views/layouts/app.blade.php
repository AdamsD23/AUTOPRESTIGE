<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AutoPrestige') | Location de véhicules à Abidjan</title>
    <meta name="description" content="@yield('description', 'Location de véhicules premium à Abidjan : SUV, berlines, sportives et électriques, avec ou sans chauffeur. Réservation en ligne, paiement Wave et Orange Money.')">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'><rect width='64' height='64' rx='16' fill='%230C1F40'/><path d='M14 40l4-11c.8-2.2 2.7-3.5 5-3.5h18c2.3 0 4.2 1.3 5 3.5l4 11v6H14z' fill='%23D9A62E'/></svg>">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0&display=block" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-800">
<div class="min-h-screen flex flex-col">

    {{-- En-tête --}}
    <header x-data="{ menu: false }" class="sticky top-0 z-40 bg-navy-900/95 backdrop-blur text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
                <x-application-logo class="w-11 h-11" />
                <span class="leading-none">
                    <span class="block text-xl font-extrabold tracking-tight">Auto<span class="text-gold-400">Prestige</span></span>
                    <span class="block text-[10px] uppercase tracking-[.3em] text-white/50">Abidjan</span>
                </span>
            </a>

            <nav class="hidden md:flex items-center gap-8 font-semibold" aria-label="Navigation principale">
                <a href="{{ route('vehicules.index') }}" class="{{ request()->routeIs('vehicules.*') ? 'text-gold-400' : 'text-white/80 hover:text-white' }}">Nos véhicules</a>
                <a href="{{ route('home') }}#comment-ca-marche" class="text-white/80 hover:text-white">Comment ça marche</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-gold-400' : 'text-white/80 hover:text-white' }}">Contact</a>
            </nav>

            <div class="hidden md:flex items-center gap-4">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.index') }}" class="px-3 py-1.5 rounded-lg bg-gold-500/15 text-gold-300 text-sm font-bold">Administration</a>
                    @endif
                    <div x-data="{ open: false }" class="relative">
                        <button type="button" @click="open = !open" @click.outside="open = false" class="flex items-center gap-2 font-semibold" :aria-expanded="open">
                            <span class="w-9 h-9 rounded-full bg-gold-500 text-navy-900 flex items-center justify-center text-sm font-extrabold">{{ auth()->user()->initiales }}</span>
                            <span class="material-symbols-outlined text-white/60">expand_more</span>
                        </button>
                        <div x-show="open" x-transition x-cloak class="absolute right-0 mt-3 w-56 rounded-2xl bg-white text-slate-700 shadow-xl py-2">
                            <p class="px-4 py-2 text-sm text-slate-400">{{ auth()->user()->nom_complet }}</p>
                            <a href="{{ route('reservations.index') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-slate-50"><span class="material-symbols-outlined text-[20px]">event_note</span>Mes réservations</a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-slate-50"><span class="material-symbols-outlined text-[20px]">person</span>Mon profil</a>
                            <form method="POST" action="{{ route('logout') }}">@csrf
                                <button class="w-full flex items-center gap-2 px-4 py-2 hover:bg-slate-50 text-red-600"><span class="material-symbols-outlined text-[20px]">logout</span>Déconnexion</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-white/80 hover:text-white">Connexion</a>
                    <a href="{{ route('vehicules.index') }}" class="px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-navy-900 font-bold transition">Réserver</a>
                @endauth
            </div>

            <button type="button" class="md:hidden w-11 h-11 rounded-xl bg-white/10 flex items-center justify-center" @click="menu = !menu" :aria-expanded="menu" aria-label="Menu">
                <span class="material-symbols-outlined" x-text="menu ? 'close' : 'menu'">menu</span>
            </button>
        </div>

        <div x-show="menu" x-transition x-cloak class="md:hidden border-t border-white/10 px-4 pb-6 pt-2 space-y-1">
            <a href="{{ route('vehicules.index') }}" class="block py-3 font-semibold">Nos véhicules</a>
            <a href="{{ route('contact') }}" class="block py-3 font-semibold">Contact</a>
            @auth
                <a href="{{ route('reservations.index') }}" class="block py-3 font-semibold">Mes réservations</a>
                <a href="{{ route('profile.edit') }}" class="block py-3 font-semibold">Mon profil</a>
                @if (auth()->user()->isAdmin())<a href="{{ route('admin.index') }}" class="block py-3 font-semibold text-gold-300">Administration</a>@endif
                <form method="POST" action="{{ route('logout') }}">@csrf<button class="py-3 font-semibold text-red-300">Déconnexion</button></form>
            @else
                <a href="{{ route('login') }}" class="block py-3 font-semibold">Connexion</a>
                <a href="{{ route('register') }}" class="block mt-2 py-3 rounded-xl bg-gold-500 text-navy-900 text-center font-bold">Créer un compte</a>
            @endauth
        </div>
    </header>

    {{-- Messages --}}
    @foreach (['success' => 'bg-emerald-600', 'error' => 'bg-red-600'] as $type => $couleur)
        @if (session($type))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)" class="fixed top-24 left-4 right-4 sm:left-auto sm:right-6 z-50 sm:max-w-md {{ $couleur }} text-white rounded-2xl shadow-xl px-5 py-4 flex items-start gap-3" role="status">
                <span class="material-symbols-outlined">{{ $type === 'success' ? 'check_circle' : 'error' }}</span>
                <p class="flex-1 font-semibold">{{ session($type) }}</p>
                <button type="button" @click="show = false" aria-label="Fermer"><span class="material-symbols-outlined">close</span></button>
            </div>
        @endif
    @endforeach

    <main class="flex-grow">
        @isset($header)
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">{{ $header }}</div>
        @endisset
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    {{-- Pied de page --}}
    <footer class="bg-navy-950 text-white/60 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 grid gap-10 md:grid-cols-4">
            <div class="md:col-span-2">
                <p class="text-2xl font-extrabold text-white">Auto<span class="text-gold-400">Prestige</span></p>
                <p class="mt-3 max-w-sm">Location de véhicules premium à Abidjan, avec ou sans chauffeur. Livraison à l'aéroport et à domicile.</p>
            </div>
            <div>
                <p class="font-bold text-white mb-3">Agence</p>
                <p>Cocody Riviera 3, Abidjan</p>
                <p>Tous les jours, 7h – 21h</p>
                <a href="https://wa.me/2250767418701" target="_blank" rel="noopener" class="inline-flex items-center gap-1 mt-2 text-gold-400 font-semibold"><span class="material-symbols-outlined text-[20px]">chat</span>WhatsApp</a>
            </div>
            <div>
                <p class="font-bold text-white mb-3">Liens</p>
                <ul class="space-y-2">
                    <li><a href="{{ route('vehicules.index') }}" class="hover:text-white">Nos véhicules</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
                    <li><a href="{{ route('reservations.index') }}" class="hover:text-white">Mes réservations</a></li>
                </ul>
            </div>
        </div>
        <p class="border-t border-white/10 py-6 text-center text-sm">© {{ date('Y') }} AutoPrestige — projet de démonstration réalisé par Adams Diarra. Photos : Unsplash.</p>
    </footer>
</div>
@stack('scripts')
</body>
</html>
