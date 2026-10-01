@extends('layouts.app')

@section('title', 'À Propos - AutoPrestige')

@section('content')
<!-- HeroSection -->
<div class="relative">
    <div class="flex min-h-[560px] flex-col gap-8 items-center justify-center p-8 text-center bg-cover bg-center bg-no-repeat" style='background-image: linear-gradient(rgba(13, 27, 42, 0.7) 0%, rgba(13, 27, 42, 0.9) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuCTkrHpioT0suv9Mfgnio8yRSt1hIzvgzVH5XpDzxiw5_XScmVvdRojsXbnKG8Fm1inufwvRzK10iV1ozaZoDobDf5pC_pDv0SJCQqba7IWY0D39ONsVf2ovn11Nn5gngfGyZ7Sp4oL7BhZlxD0TLTuHAD4U2dyg2ew8Tca1IuRcMbr-VvZh55XPNsdihrntn4kLlcc905UW4DBK5i8dggxc0vNoB9GYaCzBjVIREv5F9u5JVX9CkWI16hQbUV30dfv0z_ZjfI_a9km");'>
        <div class="flex flex-col gap-4 max-w-3xl">
            <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] md:text-6xl">
                Votre Partenaire de Confiance sur la Route
            </h1>
            <h2 class="text-gray-300 text-lg font-normal leading-normal md:text-xl">
                Découvrez notre passion pour l'excellence automobile et notre engagement à vous offrir une expérience inégalée, de la sélection à la conduite.
            </h2>
        </div>
        <div class="flex-wrap gap-4 flex justify-center">
            <a href="{{ route('vehicules') }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors">
                <span class="truncate">Découvrir nos véhicules</span>
            </a>
            <a href="{{ route('contact') }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-background-light/20 text-white text-base font-bold leading-normal tracking-[0.015em] border border-white/30 hover:bg-background-light/30 transition-colors">
                <span class="truncate">Nous contacter</span>
            </a>
        </div>
    </div>
</div>

<!-- FeatureSection (Nos Valeurs) -->
<section class="py-16 sm:py-24">
    <div class="container mx-auto px-4">
        <div class="flex flex-col gap-12 @container">
            <div class="flex flex-col gap-4 text-center">
                <h2 class="text-text-light text-3xl font-bold leading-tight tracking-[-0.033em] sm:text-4xl">
                    Nos Valeurs Fondamentales
                </h2>
                <p class="text-text-muted-light text-lg font-normal leading-normal max-w-2xl mx-auto">Les principes qui guident chacune de nos décisions et interactions pour vous garantir le meilleur service.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="flex flex-col gap-4 rounded-xl border border-border-light bg-card-light p-6 text-center items-center">
                    <span class="material-symbols-outlined text-accent text-5xl">verified_user</span>
                    <div class="flex flex-col gap-2">
                        <h3 class="text-text-light text-xl font-bold leading-tight">Confiance</h3>
                        <p class="text-text-muted-light text-base font-normal leading-normal">Transparence totale et intégrité à chaque étape de votre parcours avec nous.</p>
                    </div>
                </div>
                <div class="flex flex-col gap-4 rounded-xl border border-border-light bg-card-light p-6 text-center items-center">
                    <span class="material-symbols-outlined text-accent text-5xl">workspace_premium</span>
                    <div class="flex flex-col gap-2">
                        <h3 class="text-text-light text-xl font-bold leading-tight">Qualité</h3>
                        <p class="text-text-muted-light text-base font-normal leading-normal">Une sélection rigoureuse de véhicules inspectés pour garantir performance et fiabilité.</p>
                    </div>
                </div>
                <div class="flex flex-col gap-4 rounded-xl border border-border-light bg-card-light p-6 text-center items-center">
                    <span class="material-symbols-outlined text-accent text-5xl">support_agent</span>
                    <div class="flex flex-col gap-2">
                        <h3 class="text-text-light text-xl font-bold leading-tight">Service Client</h3>
                        <p class="text-text-muted-light text-base font-normal leading-normal">Une équipe dévouée à votre écoute pour une satisfaction client exceptionnelle.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- History Section -->
<section class="py-16 sm:py-24 bg-card-light">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-center">
            <div class="lg:w-1/2 flex flex-col gap-4">
                <h2 class="text-text-light text-3xl font-bold leading-tight tracking-[-0.033em] sm:text-4xl">Notre Histoire</h2>
                <p class="text-text-muted-light text-lg">De la passion d'un fondateur à une référence nationale, découvrez les étapes clés qui ont façonné AutoPrestige.</p>
            </div>
            <div class="lg:w-1/2 w-full">
                <div class="grid grid-cols-[auto_1fr] gap-x-4">
                    <div class="flex flex-col items-center gap-2">
                        <div class="flex items-center justify-center rounded-full bg-primary/20 size-10"><span class="material-symbols-outlined text-primary text-2xl">flag</span></div>
                        <div class="w-[2px] bg-border-light flex-grow"></div>
                    </div>
                    <div class="flex flex-1 flex-col pb-8 pt-2">
                        <p class="text-text-muted-light text-sm font-medium leading-normal">2010</p>
                        <p class="text-text-light text-lg font-semibold leading-normal">La Naissance d'une Passion</p>
                        <p class="text-text-muted-light text-base">Fondation d'AutoPrestige avec une mission simple : offrir des véhicules d'exception avec un service irréprochable.</p>
                    </div>
                    <div class="flex flex-col items-center gap-2">
                        <div class="flex items-center justify-center rounded-full bg-primary/20 size-10"><span class="material-symbols-outlined text-primary text-2xl">store</span></div>
                        <div class="w-[2px] bg-border-light flex-grow"></div>
                    </div>
                    <div class="flex flex-1 flex-col pb-8 pt-2">
                        <p class="text-text-muted-light text-sm font-medium leading-normal">2018</p>
                        <p class="text-text-light text-lg font-semibold leading-normal">Expansion Nationale</p>
                        <p class="text-text-muted-light text-base">Ouverture de notre cinquième concession, marquant notre présence dans toutes les grandes villes du pays.</p>
                    </div>
                    <div class="flex flex-col items-center gap-2">
                        <div class="flex items-center justify-center rounded-full bg-primary/20 size-10"><span class="material-symbols-outlined text-primary text-2xl">hub</span></div>
                    </div>
                    <div class="flex flex-1 flex-col pt-2">
                        <p class="text-text-muted-light text-sm font-medium leading-normal">2023</p>
                        <p class="text-text-light text-lg font-semibold leading-normal">Lancement de Notre Plateforme</p>
                        <p class="text-text-muted-light text-base">Une nouvelle ère digitale commence avec notre site web, rendant l'expérience AutoPrestige accessible à tous, partout.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-16 sm:py-24">
    <div class="container mx-auto px-4">
        <div class="flex flex-col gap-12">
            <div class="flex flex-col gap-4 text-center">
                <h2 class="text-text-light text-3xl font-bold leading-tight tracking-[-0.033em] sm:text-4xl">Rencontrez Notre Équipe</h2>
                <p class="text-text-muted-light text-lg font-normal leading-normal max-w-2xl mx-auto">Les experts passionnés qui œuvrent chaque jour pour transformer votre expérience automobile.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="flex flex-col items-center text-center gap-4">
                    <img class="size-40 rounded-full object-cover" src="" alt="Portrait de Jean Dupont">
                    <div class="flex flex-col gap-1">
                        <h3 class="text-text-light text-xl font-bold">Jean Dupont</h3>
                        <p class="text-primary text-base font-semibold">Fondateur &amp; CEO</p>
                    </div>
                </div>
                <div class="flex flex-col items-center text-center gap-4">
                    <img class="size-40 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBsAAmU3_V00Lu-xMnNo-4UCIXyDUT9AGaJtcuKEwuZwxI_Ztpfrx4bysJWUotsyF5xetK0Ht9JVwyy7Ph_PVT_67yriZH50wxH-1Wy_EbHEo1uHv_c2ciSzxNL2KW4m8O8dTjekAh5x_igA_HG86rq_sya3go3spYcuUjZUKl7bzLnx2q289s2-q9DvD6WGoTmpdlSjFZIijdKD6PypoChfNFGirbn4JqYOHZsWXKyk2mCNb5Yy-Afnw-bo12Rr8SXIBr9vq7lISEI" alt="Portrait de Marie Leclerc">
                    <div class="flex flex-col gap-1">
                        <h3 class="text-text-light text-xl font-bold">Marie Leclerc</h3>
                        <p class="text-primary text-base font-semibold">Directrice des Ventes</p>
                    </div>
                </div>
                <div class="flex flex-col items-center text-center gap-4">
                    <img class="size-40 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCN5wYxIk4ICum_Dj1-s1GJqGZ8pVzzvnYJ73cpI-xVgkRepq4qe_1pS1rXIgriTuoyHn47H8jZJ2pyAelMIAWLyMvVjgHLTaJVbD2zvYP0s4NyNLLPwtJ_05ueeVEhBMTwOlhE0tIQMhUUobIdPUF8twOay8p-SSuo_sZZQza_kAjHsJsW0i555NQLW-1oSfdG-htVl0lEqEbKogAEhNt6prnGZqpF0IzoofABM-EINrwVjxfgB4AmGcvi0Glvx_HWnRBLUydwAGTy" alt="Portrait de Paul Martin">
                    <div class="flex flex-col gap-1">
                        <h3 class="text-text-light text-xl font-bold">Paul Martin</h3>
                        <p class="text-primary text-base font-semibold">Responsable Location</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-primary/10 py-16 sm:py-24">
    <div class="container mx-auto px-4">
        <div class="flex flex-col items-center gap-6 text-center max-w-3xl mx-auto">
            <h2 class="text-text-light text-3xl font-bold leading-tight tracking-[-0.033em] sm:text-4xl">Prêt à prendre la route ?</h2>
            <p class="text-text-muted-light text-lg">Explorez notre sélection de véhicules premium disponibles à la vente ou à la location. Votre prochaine voiture vous attend.</p>
            <a href="{{ route('vehicules') }}" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-accent text-white text-base font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity">
                <span class="truncate">Voir le catalogue</span>
            </a>
        </div>
    </div>
</section>
@endsection
 