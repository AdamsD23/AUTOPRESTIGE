@extends('layouts.app')

@section('title', 'AutoPrestige - Votre partenaire de confiance')

@push('styles')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fadeInUp {
        animation: fadeInUp 0.8s ease-out forwards;
    }
    
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-scale:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .parallax {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
@endpush

@section('content')
<main>
<!-- HeroSection avec animation de fond -->
<div class="relative overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/backgrounds/car-rental-bg.jpg') }}');">
            <div class="absolute inset-0 bg-gradient-to-b from-[#003366]/90 to-black/80"></div>
        </div>
    </div>
    
    <div class="relative z-10 min-h-screen flex flex-col items-center justify-center px-4 py-20 text-center">
        <div class="max-w-4xl mx-auto space-y-8">
            <div class="overflow-hidden">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold leading-tight tracking-tight animate-fadeInUp" style="animation-delay: 0.2s">
                    <span class="text-white drop-shadow-lg">L'<span class="text-blue-300">Excellence</span> Automobile</span><br>
                    <span class="text-xl md:text-2xl font-semibold text-white mt-6 block bg-black/40 px-4 py-2 rounded-lg inline-block">Votre partenaire de confiance pour des locations haut de gamme</span>
                </h1>
            </div>
            
            <div class="overflow-hidden">
                <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed animate-fadeInUp" style="animation-delay: 0.4s">
                    Découvrez une collection exclusive de véhicules premium soigneusement sélectionnés pour répondre à vos attentes les plus exigeantes en matière de confort, de performance et d'élégance.
                </p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center pt-6 animate-fadeInUp" style="animation-delay: 0.6s">
                <a href="{{ route('vehicules') }}" class="group relative overflow-hidden px-8 py-4 bg-gradient-to-r from-[#003366] to-[#003366] text-white font-bold rounded-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <span class="relative z-10">Explorer notre flotte</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-[#003366] to-[#003366] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                <a href="{{ route('contact') }}" class="group relative overflow-hidden px-8 py-4 bg-transparent border-2 border-white/30 text-white font-bold rounded-lg hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1">
                    <span class="relative z-10 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Faites-nous signe !
                    </span>
                </a>
            </div>
        </div>
        
        <!-- Statistiques -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-5xl mx-auto mt-20 w-full px-4">
            <div class="relative bg-white/5 backdrop-blur-sm rounded-xl p-6 text-center border border-white/10 hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg overflow-hidden group">
                <div class="relative z-10">
                    <div class="text-4xl font-bold text-[#003366] mb-2">500+</div>
                    <div class="text-gray-300">Véhicules disponibles</div>
                </div>
            </div>
            <div class="relative bg-white/5 backdrop-blur-sm rounded-xl p-6 text-center border border-white/10 hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg overflow-hidden group">
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1503376785-2acd72611164')] bg-cover bg-center opacity-10 group-hover:opacity-20 transition-opacity duration-300 -z-10"></div>
                <div class="relative z-10">
                    <div class="text-4xl font-bold text-[#003366] mb-2">98%</div>
                    <div class="text-gray-300">Clients satisfaits</div>
                </div>
            </div>
            <div class="relative bg-white/5 backdrop-blur-sm rounded-xl p-6 text-center border border-white/10 hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg overflow-hidden group">
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1503376785-2acd72611164')] bg-cover bg-center opacity-10 group-hover:opacity-20 transition-opacity duration-300 -z-10"></div>
                <div class="relative z-10">
                    <div class="text-4xl font-bold text-[#003366] mb-2">15+</div>
                    <div class="text-gray-300">Années d'expérience</div>
                </div>
            </div>
            <div class="relative bg-white/5 backdrop-blur-sm rounded-xl p-6 text-center border border-white/10 hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg overflow-hidden group">
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1503376785-2acd72611164')] bg-cover bg-center opacity-10 group-hover:opacity-20 transition-opacity duration-300 -z-10"></div>
                <div class="relative z-10">
                    <div class="text-4xl font-bold text-[#003366] mb-2">24/7</div>
                    <div class="text-gray-300">Assistance disponible</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Flèche de défilement -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
        <a href="#services" class="text-white hover:text-[#003366] transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </a>
    </div>
</div>

<!-- Section Services -->
<section id="services" class="relative py-20 bg-gray-50 overflow-hidden">
    <!-- Éléments décoratifs -->
    <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-black/5 to-transparent"></div>
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-[#003366]/5 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-[#003366]/10 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>
    
    <div class="container mx-auto px-4 relative">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-1 text-sm font-semibold text-[#003366] bg-[#003366]/10 rounded-full mb-4">Nos Services</span>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Une expérience de location exceptionnelle</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-[#003366] to-[#003366] mx-auto"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Carte 1 -->
            <div class="group bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                <div class="w-16 h-16 bg-[#003366]/10 rounded-xl flex items-center justify-center text-[#003366] mb-6 group-hover:bg-[#003366] group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined text-4xl">directions_car</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Large Sélection de Véhicules</h3>
                <p class="text-gray-600 mb-6">Découvrez notre flotte diversifiée de véhicules haut de gamme, soigneusement entretenus et contrôlés pour votre sécurité.</p>
                <a href="#" class="inline-flex items-center text-[#003366] font-medium group-hover:text-[#003366] transition-colors">
                    En savoir plus
                    <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
            
            <!-- Carte 2 -->
            <div class="group bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                <div class="w-16 h-16 bg-[#003366]/10 rounded-xl flex items-center justify-center text-[#003366] mb-6 group-hover:bg-[#003366] group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined text-4xl">support_agent</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Service Client Premium</h3>
                <p class="text-gray-600 mb-6">Notre équipe dévouée est disponible 24/7 pour répondre à vos questions et vous assister à chaque étape de votre location.</p>
                <a href="#" class="inline-flex items-center text-[#003366] font-medium group-hover:text-[#003366] transition-colors">
                    En savoir plus
                    <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
            
            <!-- Carte 3 -->
            <div class="group bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                <div class="w-16 h-16 bg-[#003366]/10 rounded-xl flex items-center justify-center text-[#003366] mb-6 group-hover:bg-[#003366] group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined text-4xl">security</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Sécurité Garantie</h3>
                <p class="text-gray-600 mb-6">Tous nos véhicules sont équipés des dernières technologies de sécurité et parfaitement entretenus pour votre tranquillité d'esprit.</p>
                <a href="#" class="inline-flex items-center text-[#003366] font-medium group-hover:text-[#003366] transition-colors">
                    En savoir plus
                    <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
        
        <!-- Section CTA -->
        <div class="mt-20 bg-gradient-to-r from-[#003366] to-[#003366] rounded-2xl p-8 md:p-12 text-center relative overflow-hidden">
            <div class="relative z-10 max-w-3xl mx-auto">
                <h3 class="text-3xl md:text-4xl font-bold text-white mb-6">Prêt à vivre l'expérience AutoPrestige ?</h3>
                <p class="text-lg text-[#e6ecf5] mb-8">Réservez dès maintenant votre véhicle de luxe et profitez d'un service exceptionnel.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('vehicules') }}" class="bg-white text-[#003366] hover:bg-gray-100 font-bold py-4 px-8 rounded-lg transition-all duration-300 transform hover:scale-105 inline-flex items-center">
                        <span class="mr-2">Réserver maintenant</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}" class="bg-transparent border-2 border-white text-white hover:bg-white/10 font-bold py-4 px-8 rounded-lg transition-all duration-300 transform hover:scale-105">
                        Nous contacter
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Newsletter -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="md:flex">
                <div class="md:flex-shrink-0 md:w-1/2 bg-gradient-to-br from-[#003366] to-[#003366] p-10 flex flex-col justify-center">
                    <h3 class="text-2xl font-bold text-white mb-4">Restez informé</h3>
                    <p class="text-[#e6ecf5] mb-6">Inscrivez-vous à notre newsletter pour recevoir nos offres exclusives et actualités.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-blue-200 transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-blue-200 transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-blue-200 transition-colors">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="p-10">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Newsletter</h3>
                    <p class="text-gray-600 mb-6">Abonnez-vous pour recevoir nos dernières actualités et offres spéciales.</p>
                    <form class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
                            <input type="email" id="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="votre@email.com">
                        </div>
                        <div class="flex items-center">
                            <input id="privacy" type="checkbox" class="h-4 w-4 text-[#003366] focus:ring-[#003366] border-gray-300 rounded">
                            <label for="privacy" class="ml-2 block text-sm text-gray-700">
                                J'accepte la <a href="#" class="text-[#003366] hover:underline">politique de confidentialité</a>
                            </label>
                        </div>
                        <button type="submit" class="w-full bg-[#003366] hover:bg-[#003366] text-white font-bold py-3 px-6 rounded-lg transition-colors">
                            S'abonner
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
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
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-[#003366]/10 text-[#003366]">
                    <span class="material-symbols-outlined text-4xl">verified_user</span>
                </div>
                <h3 class="mt-4 text-xl font-semibold text-gray-900">Garantie 12 mois incluse</h3>
                <p class="mt-2 text-gray-600">Conduisez sereinement avec notre garantie complète sur tous nos véhicules d'occasion.</p>
            </div>
            <div class="flex flex-col items-center text-center p-6">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-[#003366]/10 text-[#003366]">
                    <span class="material-symbols-outlined text-4xl">local_shipping</span>
                </div>
                <h3 class="mt-4 text-xl font-semibold text-gray-900">Livraison à domicile</h3>
                <p class="mt-2 text-gray-600">Recevez votre nouvelle voiture directement chez vous, partout en France.</p>
            </div>
            <div class="flex flex-col items-center text-center p-6">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-[#003366]/10 text-[#003366]">
                    <span class="material-symbols-outlined text-4xl">account_balance_wallet</span>
                </div>
                <h3 class="mt-4 text-xl font-semibold text-gray-900">Financement sur mesure</h3>
                <p class="mt-2 text-gray-600">Nous trouvons la solution de financement adaptée à votre budget et vos besoins.</p>
            </div>
        </div>
    </div>
</section>
</main>
@endsection
