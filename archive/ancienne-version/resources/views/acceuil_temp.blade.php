@extends('layouts.app')

@section('title', 'AutoPrestige - Location de véhicules de luxe')

@section('content')
<section class="relative h-[600px] lg:h-[700px] overflow-hidden">
    <div class="absolute inset-0 z-[-1]">
        <img 
            alt="Voiture de sport noire de luxe sur route de montagne" 
            class="h-full w-full object-cover" 
            src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" 
            loading="eager"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-black/20"></div>
    </div>
    <div class="relative container mx-auto px-4 h-full flex flex-col items-center justify-center text-center">
        <div class="text-white max-w-3xl">
            <h1 class="text-4xl font-black leading-tight tracking-tighter md:text-6xl">Louez le véhicule de vos rêves</h1>
            <p class="mt-4 text-lg text-gray-200">Découvrez notre flotte de véhicules de luxe et trouvez la voiture parfaite pour votre prochain voyage.</p>
        </div>
    </div>
</section>

<section class="relative z-10 -mt-20">
    <div class="container mx-auto px-4">
        <div class="w-full max-w-4xl mx-auto rounded-xl bg-white p-6 shadow-2xl">
            <div class="flex flex-col gap-4 md:flex-row md:items-end">
                <div class="w-full">
                <div class="text-white bg-blue-600 px-6 py-3 rounded-lg inline-block font-bold">
                    Location de véhicules de luxe
                </div>
            </div>
                <div class="relative grow">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                    <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg bg-gray-100 border-transparent focus:border-primary focus:ring-primary/50 focus:ring-2 h-12 placeholder:text-gray-500 pl-10 pr-4 text-base font-normal leading-normal" placeholder="Rechercher par marque, modèle ou catégorie..." />
                </div>
                <button class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] shadow-sm transition-opacity hover:opacity-90 md:w-auto">
                    <span class="truncate">Trouver un véhicule</span>
                </button>
            </div>
            <div class="mt-16">
                <h3 class="text-xl font-bold text-[#003366] mb-6">Explorer par catégorie</h3>
                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                    <a class="group relative block h-40 overflow-hidden rounded-xl shadow-lg transition-transform duration-300 hover:-translate-y-1" href="#">
                        <img alt="A modern white SUV parked in a scenic location" class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCW2Vo3AjbVo6qLteH0-0Edi6c7pvz7ySghPMLnqyOVHDPSQT2y6LgjuYD1V7S3wxMHeOjLcnhK3iTsMK_P7zOkpt9lfrttdgJicoyoMs3JMVtibCKV0kWIsqbrdvNXaiXP-seqL28AEZ3Wek56L9OwmE_Vghn0tdae1Sq8XRMv05aZ9TMcWeM1zdZDfUPlAYwftoeaT1QUI3v-QYrddhhR50Icuk59Yl-ruBmRzwUBwRex5CpusFxoDUdke-EhdxlwyWY0aVS4wYqJ" />
                        <div class="absolute inset-0 bg-black/50"></div>
                        <div class="relative flex h-full items-center justify-center z-10">
                            <h4 class="text-xl font-bold text-white">SUV</h4>
                        </div>
                    </a>
                    <a class="group relative block h-40 overflow-hidden rounded-xl shadow-lg transition-transform duration-300 hover:-translate-y-1" href="#">
                        <img alt="A sleek black sedan driving on a city street at night" class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCXweo1gYE_g2G_hvBqvMiGsgTrsM1o23zI-qRy3N3CADHfIMh4DoiH9jZeQtRgFp6L28HeCES9LPfZAu-Dj7F0BxK9y6OHO1rod_typt3lDwvUjfo_o4RkqTDe7Kw6qIrZYmNIw69QqN1Zd5k-oKiiBzThtn2gxdh0AnkwScTUrHjtf6QkR1BZI8jV4jj9OApdcGZfb5AiZ9mZkY2z7e1gnD_glcg-eGFUsIqSOJqXi1X5QT6TN6XIOtXCAdYbAZzegERErAUu52dg" />
                        <div class="absolute inset-0 bg-black/50"></div>
                        <div class="relative flex h-full items-center justify-center z-10">
                            <h4 class="text-xl font-bold text-white">Berlines</h4>
                        </div>
                    </a>
                    <a class="group relative block h-40 overflow-hidden rounded-xl shadow-lg transition-transform duration-300 hover:-translate-y-1" href="#">
                        <img alt="An electric car being charged at a charging station" class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBl7dvPdk53fcHJC8jE2FRJRQYS9bLOJzeGaF2dzYxfQpOoTykMTeKHS4WObH4cbD_Xt4vZ5I8DRJh0DzblXh32meexObWwiXhGhOK8NGLqn9EBABcFANGeyohg7f0szHBrQ3RmSaGCWT2jrrWXVx3LbE_wSpl_wk2CtM5dCPnS_V04d9UGfsmE-txhMfBSEHZdBPAd_IS5LXUHX3RYoEnhGvvnDFuj83mKq6UetTpVSjkxGgEEiQepalGtriiHVdg86r3gaOpEQNI6" />
                        <div class="absolute inset-0 bg-black/50"></div>
                        <div class="relative flex h-full items-center justify-center z-10">
                            <h4 class="text-xl font-bold text-white">Électriques</h4>
                        </div>
                    </a>
                    <a class="group relative block h-40 overflow-hidden rounded-xl shadow-lg transition-transform duration-300 hover:-translate-y-1" href="#">
                        <img alt="A white commercial van parked in a warehouse" class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkzkLk-MPeUCKpDa16drjeisZKgDti_O4IGh6epy9V3HVWWvWDDTvf86UWunQzbX4pT3C3u8_mRaQs2MmoafYFm2LpiqCxs2vATTX8_LDtVKrbD9ngF9V_LNg3xpH9gpAJwZboWym2PXjTVkyr33VdfrUBo0dVlneI_MxIQCTWC39LfNCoSGRSZ5a01F2W-ABNXEnbc_ZayVOxZCH74mIBpYbuc5Wx5zuoRiL_g9nD0ZXk_4TbEF1ti982UTNNgp9GLhdePoeSbJZV" />
                        <div class="absolute inset-0 bg-black/50"></div>
                        <div class="relative flex h-full items-center justify-center z-10">
                            <h4 class="text-xl font-bold text-white">Utilitaires</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 sm:py-24">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-[#003366]">Pourquoi nous choisir ?</h2>
            <p class="mt-2 text-lg text-gray-600">Nos engagements pour votre tranquillité d'esprit.</p>
        </div>
        <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-3">
            <div class="flex flex-col items-center text-center p-6">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary">
                    <span class="material-symbols-outlined text-4xl">verified_user</span>
                </div>
                <h3 class="mt-4 text-xl font-semibold text-gray-900">Garantie 12 mois incluse</h3>
                <p class="mt-2 text-gray-600">Conduisez sereinement avec notre garantie complète sur tous nos véhicules d'occasion.</p>
            </div>
            <div class="flex flex-col items-center text-center p-6">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary">
                    <span class="material-symbols-outlined text-4xl">local_shipping</span>
                </div>
                <h3 class="mt-4 text-xl font-semibold text-gray-900">Livraison à domicile</h3>
                <p class="mt-2 text-gray-600">Recevez votre nouvelle voiture directement chez vous, partout en France.</p>
            </div>
            <div class="flex flex-col items-center text-center p-6">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary">
                    <span class="material-symbols-outlined text-4xl">account_balance_wallet</span>
                </div>
                <h3 class="mt-4 text-xl font-semibold text-gray-900">Financement sur mesure</h3>
                <p class="mt-2 text-gray-600">Nous trouvons la solution de financement adaptée à votre budget et vos besoins.</p>
            </div>
        </div>
    </div>
</section>
@endsection
