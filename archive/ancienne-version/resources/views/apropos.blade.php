@extends('layouts.app')

@section('title', 'À Propos - AutoPrestige')

@push('styles')
<style>
    /* Animations */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Classes utilitaires */
    .animate-float { animation: float 6s ease-in-out infinite; }
    .fade-in { animation: fadeIn 0.8s ease-out forwards; }
    
    /* Couleurs Ivoiriennes Modernes */
    .bg-ivoire { background-color: #FFF9F0; }
    .text-ivoire { color: #FFF9F0; }
    .border-ivoire { border-color: #FFF9F0; }
    
    .bg-orange { background-color: #FF6B00; }
    .text-orange { color: #FF6B00; }
    .border-orange { border-color: #FF6B00; }
    
    .bg-vert { background-color: #1B5E20; }
    .text-vert { color: #1B5E20; }
    .border-vert { border-color: #1B5E20; }
    
    .bg-or { background-color: #FFC107; }
    .text-or { color: #FFC107; }
    
    /* Dégradés */
    .bg-ivoirien-gradient {
        background: linear-gradient(135deg, #FF6B00 0%, #FFC107 50%, #1B5E20 100%);
    }
    
    .bg-ivoirien-dark {
        background: linear-gradient(135deg, #1B5E20 0%, #0D47A1 100%);
    }
    
    /* Effets de survol */
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-scale:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    /* Styles personnalisés */
    .text-shadow {
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .btn-primary {
        @apply px-6 py-3 rounded-full font-bold transition-all duration-300 transform hover:scale-105;
        background: linear-gradient(45deg, #FF6B00, #FF9800);
        color: white;
        box-shadow: 0 4px 15px rgba(255, 107, 0, 0.3);
    }
    
    .btn-primary:hover {
        background: linear-gradient(45deg, #E65100, #F57C00);
        box-shadow: 0 6px 20px rgba(255, 107, 0, 0.4);
    }
    
    .section-title {
        @apply text-4xl md:text-5xl font-extrabold text-center mb-6 relative;
    }
    
    .section-title:after {
        content: '';
        @apply block w-24 h-1.5 bg-gradient-to-r from-orange-500 via-yellow-400 to-green-600 mx-auto mt-4 rounded-full;
    }
    
    .card {
        @apply bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 hover:shadow-xl;
    }
</style>
@endpush

@section('content')
<!-- Hero Section avec style ivoirien moderne -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-ivoirien-gradient">
    <!-- Bannière avec les couleurs du drapeau ivoirien -->
    <div class="absolute top-0 left-0 w-full h-2 bg-orange-500"></div>
    <div class="absolute top-2 left-0 w-full h-2 bg-white"></div>
    <div class="absolute top-4 left-0 w-full h-2 bg-green-600"></div>
    
    <!-- Effets de fond animés -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1503376785-2acd72611164?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80')] bg-cover bg-center opacity-20"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/30 to-black/60"></div>
        
        <!-- Éléments décoratifs -->
        <div class="absolute top-1/4 -left-20 w-64 h-64 bg-orange-400/20 rounded-full mix-blend-multiply filter blur-3xl"></div>
        <div class="absolute top-1/2 -right-20 w-72 h-72 bg-green-500/20 rounded-full mix-blend-multiply filter blur-3xl"></div>
        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-full h-32 bg-gradient-to-t from-black to-transparent"></div>
    </div>
    
    <!-- Contenu principal -->
    <div class="relative z-10 container mx-auto px-4 py-20">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Drapeau animé -->
            <div class="mb-8 animate-float">
                <div class="inline-block bg-white p-4 rounded-2xl shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/Flag_of_Cote_d%27Ivoire.svg" 
                         alt="Drapeau de la Côte d'Ivoire" 
                         class="h-20 md:h-24 mx-auto rounded-lg shadow-md">
                </div>
            </div>
            
            <!-- Titre principal -->
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight">
                <span class="text-orange-300">Auto</span><span class="text-white">Prestige</span> 
                <span class="text-green-300">CI</span>
            </h1>
            
            <!-- Sous-titre -->
            <p class="text-xl md:text-2xl text-gray-100 max-w-3xl mx-auto mb-10">
                L'excellence automobile au cœur de la Côte d'Ivoire
            </p>
            
            <!-- Boutons d'action -->
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#notre-histoire" class="btn-primary inline-flex items-center px-8 py-4 text-lg">
                    <span>Découvrir notre histoire</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </a>
                
                <a href="#contact" class="bg-white/10 backdrop-blur-md hover:bg-white/20 text-white font-bold px-8 py-4 rounded-full border-2 border-white/20 transition-all duration-300 hover:border-white/40 flex items-center">
                    <span>Nous contacter</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
        
        <!-- Indicateur de défilement -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
            <a href="#notre-histoire" class="text-white/70 hover:text-white transition-colors animate-bounce inline-block">
                <span class="block text-sm mb-2">Défiler</span>
                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Notre Histoire Section -->
<section id="notre-histoire" class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center mb-20">
            <span class="inline-block px-6 py-2 text-sm font-semibold text-orange-600 bg-orange-50 rounded-full mb-4 shadow-sm">Notre Histoire</span>
            <h2 class="section-title text-gray-900">L'Excellence Automobile en Côte d'Ivoire</h2>
            <p class="text-xl text-gray-600 mt-6 max-w-3xl mx-auto">
                Découvrez l'histoire passionnante d'AutoPrestige et notre engagement envers l'excellence automobile
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Image avec éléments décoratifs -->
            <div class="relative">
                <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl transform hover:rotate-0 transition-transform duration-500 -rotate-1">
                    <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" 
                         alt="Showroom AutoPrestige Abidjan" 
                         class="w-full h-auto rounded-lg transition-transform duration-700 hover:scale-105">
                </div>
                
                <!-- Éléments décoratifs -->
                <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-orange-100 rounded-full -z-10"></div>
                <div class="absolute -top-6 -left-6 w-32 h-32 bg-green-100 rounded-full -z-10"></div>
                
                <!-- Badge d'expérience -->
                <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 bg-white shadow-xl rounded-full px-6 py-3 flex items-center">
                    <div class="flex-shrink-0 w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-xl mr-3">10+</div>
                    <div class="text-left">
                        <div class="font-bold text-gray-900">Années</div>
                        <div class="text-sm text-gray-500">d'expérience</div>
                    </div>
                </div>
            </div>
            
            <!-- Contenu texte -->
            <div class="space-y-6">
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">Notre Engagement envers l'Excellence</h3>
                
                <p class="text-lg text-gray-600 leading-relaxed">
                    Fondé en 2010 à Abidjan, AutoPrestige s'est rapidement imposé comme une référence incontournable dans le domaine de la location de véhicules haut de gamme en Côte d'Ivoire. Notre passion pour l'automobile et notre engagement envers un service exceptionnel nous ont permis de devenir le partenaire privilégié d'une clientèle exigeante.
                </p>
                
                <!-- Citation -->
                <div class="relative bg-orange-50 p-6 rounded-xl border-l-4 border-orange-500 mt-8">
                    <div class="absolute -top-4 left-6 w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <p class="text-orange-800 font-medium italic pl-4">
                        « Notre mission est de vous offrir une expérience de location inégalée, alliant confort, sécurité et élégance à travers notre sélection rigoureuse de véhicules premium. »
                    </p>
                    <div class="flex items-center mt-4">
                        <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold mr-3">AK</div>
                        <div>
                            <div class="font-semibold text-gray-900">Amadou Koné</div>
                            <div class="text-sm text-orange-600">Fondateur & PDG</div>
                        </div>
                    </div>
                </div>
                
                <!-- Statistiques -->
                <div class="grid grid-cols-2 gap-6 mt-8">
                    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:border-orange-200 transition-all duration-300">
                        <div class="text-4xl font-bold text-orange-600 mb-2">500+</div>
                        <div class="text-gray-600">Clients satisfaits</div>
                        <div class="w-12 h-1 bg-orange-500 mt-3 rounded-full"></div>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:border-green-200 transition-all duration-300">
                        <div class="text-4xl font-bold text-green-600 mb-2">50+</div>
                        <div class="text-gray-600">Véhicules disponibles</div>
                        <div class="w-12 h-1 bg-green-500 mt-3 rounded-full"></div>
                    </div>
                </div>
                
                <!-- Bouton d'action -->
                <div class="pt-6 flex flex-wrap gap-4">
                    <a href="#contact" class="btn-primary inline-flex items-center px-8 py-3 text-lg">
                        <span>Réserver maintenant</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    
                    <a href="#" class="inline-flex items-center px-6 py-3 border-2 border-gray-200 text-gray-700 font-bold rounded-full hover:bg-gray-50 transition-colors duration-300">
                        <span>Notre flotte</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section class="relative py-20 bg-gray-900">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1503376785-2acd72611164?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80')] bg-cover bg-center opacity-30"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/90 via-black/60 to-black/90"></div>
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/dark-mosaic.png')] opacity-10"></div>
        
        <!-- Floating elements -->
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute top-1/3 right-1/4 w-72 h-72 bg-purple-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-1/4 left-1/2 w-64 h-64 bg-pink-500/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="relative z-10 container mx-auto px-4 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="text-center lg:text-left fade-in-up">
                <span class="inline-block px-4 py-1.5 text-sm font-semibold text-primary bg-primary/10 rounded-full mb-6 animate-pulse">
                    L'Excellence Automobile Depuis 2010
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 leading-tight">
                    <span class="gradient-text">Votre Partenaire</span><br>
                    <span class="text-3xl md:text-4xl font-normal text-gray-300">de Confiance en Location de Luxe</span>
                </h1>
                <p class="text-lg text-gray-300 mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                    Basé en Côte d'Ivoire, AutoPrestige allie passion automobile et excellence du service pour vous offrir une expérience de location inégalée. Notre flotte de véhicules haut de gamme est spécialement sélectionnée pour répondre aux besoins des conducteurs ivoiriens les plus exigeants.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('vehicules') }}" class="group relative overflow-hidden bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white font-bold py-4 px-8 rounded-lg transition-all duration-300 transform hover:scale-105 inline-flex items-center">
                        <span class="relative z-10 flex items-center">
                            <span class="mr-2">Découvrir notre flotte</span>
                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </span>
                        <span class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </a>
                    <a href="#contact" class="group relative overflow-hidden bg-transparent border-2 border-white/30 hover:border-white/50 text-white font-bold py-4 px-8 rounded-lg transition-all duration-300 transform hover:scale-105 inline-flex items-center">
                        <span class="relative z-10 flex items-center">
                            <span class="mr-2">Nous contacter</span>
                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </span>
                        <span class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </a>
                </div>
            </div>
            
            <div class="relative hidden lg:block fade-in-up animate-delay-200">
                <div class="relative z-10">
                    <div class="absolute -top-8 -left-8 w-72 h-72 bg-blue-500/20 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob"></div>
                    <div class="absolute -bottom-8 -right-8 w-72 h-72 bg-purple-500/20 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000"></div>
                    
                    <div class="relative z-10 bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-1 shadow-2xl transform rotate-1 hover:rotate-0 transition-all duration-500">
                        <div class="overflow-hidden rounded-xl">
                            <img src="https://images.unsplash.com/photo-1503376785-2acd72611164?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                                 alt="Showroom AutoPrestige" 
                                 class="w-full h-auto rounded-lg transition-transform duration-700 hover:scale-105">
                        </div>
                        <div class="absolute -bottom-5 -right-5 rounded-lg shadow-lg overflow-hidden group w-auto min-w-[180px]">
                            <img src="https://images.unsplash.com/photo-1503376785-2acd72611164?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" 
                                 alt="Clients satisfaits"
                                 class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition-colors duration-300"></div>
                            <div class="relative z-10 px-6 py-2 text-white font-bold text-center">
                                <div class="text-2xl font-black">+500</div>
                                <div class="text-sm font-medium">clients satisfaits</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20">
            <a href="#valeurs" class="text-white/70 hover:text-white transition-colors animate-bounce">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Valeurs Section -->
<section id="valeurs" class="py-20 bg-white relative overflow-hidden">
    <div class="absolute inset-0 bg-pattern opacity-5"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16 fade-in-up">
            <span class="inline-block px-4 py-1.5 text-sm font-semibold text-primary bg-primary/10 rounded-full mb-4">Nos Valeurs</span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Ce qui nous distingue</h2>
            <div class="w-24 h-1.5 bg-gradient-to-r from-primary to-blue-500 mx-auto rounded-full"></div>
            <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto">
                Chez AutoPrestige, nous nous engageons à fournir une expérience exceptionnelle à chaque client.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Valeur 1 -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 fade-in-up">
                <div class="w-20 h-20 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300 mx-auto">
                    <span class="material-symbols-outlined text-4xl">verified_user</span>
                </div>
                <h3 class="text-2xl font-bold text-center text-gray-900 mb-4">Confiance</h3>
                <p class="text-gray-600 text-center">
                    Nous construisons des relations durables basées sur la transparence et l'intégrité à chaque étape de votre expérience avec nous.
                </p>
                <div class="mt-6 flex justify-center">
                    <span class="h-1 w-12 bg-gradient-to-r from-primary to-blue-500 rounded-full group-hover:w-16 transition-all duration-300"></span>
                </div>
            </div>
            
            <!-- Valeur 2 -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 fade-in-up animate-delay-200">
                <div class="w-20 h-20 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300 mx-auto">
                    <span class="material-symbols-outlined text-4xl">star</span>
                </div>
                <h3 class="text-2xl font-bold text-center text-gray-900 mb-4">Excellence</h3>
                <p class="text-gray-600 text-center">
                    Nous nous engageons à fournir un service exceptionnel et des véhicules de la plus haute qualité pour dépasser vos attentes.
                </p>
                <div class="mt-6 flex justify-center">
                    <span class="h-1 w-12 bg-gradient-to-r from-primary to-blue-500 rounded-full group-hover:w-16 transition-all duration-300"></span>
                </div>
            </div>
            
            <!-- Valeur 3 -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 fade-in-up animate-delay-400">
                <div class="w-20 h-20 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300 mx-auto">
                    <span class="material-symbols-outlined text-4xl">diversity_3</span>
                </div>
                <h3 class="text-2xl font-bold text-center text-gray-900 mb-4">Engagement Client</h3>
                <p class="text-gray-600 text-center">
                    Votre satisfaction est notre priorité absolue. Nous écoutons et répondons à vos besoins avec attention et professionnalisme.
                </p>
                <div class="mt-6 flex justify-center">
                    <span class="h-1 w-12 bg-gradient-to-r from-primary to-blue-500 rounded-full group-hover:w-16 transition-all duration-300"></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Équipe Section -->
<section class="py-20 bg-gray-50 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0 bg-[url('https://www.toptal.com/designers/subtlepatterns/uploads/dot-grid.png')]"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16 fade-in-up">
            <span class="inline-block px-4 py-1.5 text-sm font-semibold text-primary bg-primary/10 rounded-full mb-4">Notre Équipe</span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Rencontrez notre équipe</h2>
            <div class="w-24 h-1.5 bg-gradient-to-r from-primary to-blue-500 mx-auto rounded-full"></div>
            <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto">
                Des professionnels passionnés dédiés à votre satisfaction
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Membre 1 -->
            <div class="group text-center fade-in-up">
                <div class="relative overflow-hidden rounded-2xl mb-6 h-80 transform transition-all duration-500 group-hover:-translate-y-2">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent z-10 transition-all duration-500 group-hover:opacity-0"></div>
                    <img src="{{ asset('images/IV1.jpg') }}" 
                         alt="Directeur Général" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-left z-20 transition-all duration-500 transform translate-y-2 group-hover:translate-y-0">
                        <h4 class="text-xl font-bold text-white">Jean Kouassi</h4>
                        <p class="text-primary font-medium">Directeur Général</p>
                        <p class="text-sm text-gray-300 mt-1">Côte d'Ivoire</p>
                        <div class="flex space-x-3 mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <a href="#" class="text-white hover:text-primary transition-colors">
                                <span class="sr-only">LinkedIn</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Membre 2 -->
            <div class="group text-center fade-in-up animate-delay-200">
                <div class="relative overflow-hidden rounded-2xl mb-6 h-80 transform transition-all duration-500 group-hover:-translate-y-2">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent z-10 transition-all duration-500 group-hover:opacity-0"></div>
                    <img src="{{ asset('images/IV2.jpg') }}" 
                         alt="Responsable Commercial" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-left z-20 transition-all duration-500 transform translate-y-2 group-hover:translate-y-0">
                        <h4 class="text-xl font-bold text-white">Aminata Koné</h4>
                        <p class="text-primary font-medium">Responsable Commercial</p>
                        <p class="text-sm text-gray-300 mt-1">Côte d'Ivoire</p>
                        <div class="flex space-x-3 mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <a href="#" class="text-white hover:text-primary transition-colors">
                                <span class="sr-only">LinkedIn</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Membre 3 -->
            <div class="group text-center fade-in-up animate-delay-400">
                <div class="relative overflow-hidden rounded-2xl mb-6 h-80 transform transition-all duration-500 group-hover:-translate-y-2">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent z-10 transition-all duration-500 group-hover:opacity-0"></div>
                    <img src="{{ asset('images/IV3.jpg') }}" 
                         alt="Service Client" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-left z-20 transition-all duration-500 transform translate-y-2 group-hover:translate-y-0">
                        <h4 class="text-xl font-bold text-white">Yacouba Bamba</h4>
                        <p class="text-primary font-medium">Service Client</p>
                        <p class="text-sm text-gray-300 mt-1">Côte d'Ivoire</p>
                        <div class="flex space-x-3 mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <a href="#" class="text-white hover:text-primary transition-colors">
                                <span class="sr-only">LinkedIn</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Membre 4 -->
            <div class="group text-center fade-in-up animate-delay-600">
                <div class="relative overflow-hidden rounded-2xl mb-6 h-80 transform transition-all duration-500 group-hover:-translate-y-2">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent z-10 transition-all duration-500 group-hover:opacity-0"></div>
                    <img src="{{ asset('images/IV4.jpg') }}" 
                         alt="Responsable Maintenance" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-left z-20 transition-all duration-500 transform translate-y-2 group-hover:translate-y-0">
                        <h4 class="text-xl font-bold text-white">Fatou Traoré</h4>
                        <p class="text-primary font-medium">Responsable Maintenance</p>
                        <p class="text-sm text-gray-300 mt-1">Côte d'Ivoire</p>
                        <div class="flex space-x-3 mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <a href="#" class="text-white hover:text-primary transition-colors">
                                <span class="sr-only">LinkedIn</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="relative py-24 bg-gradient-to-b from-gray-50 to-white overflow-hidden">
    <!-- Background elements -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80')] bg-cover bg-center opacity-10"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-orange-500/5 via-transparent to-green-600/5"></div>
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-orange-500 via-white to-green-600"></div>
    </div>
    
    <div class="relative z-10 container mx-auto px-4">
        <div class="text-center mb-20">
            <span class="inline-block px-6 py-2 text-sm font-semibold text-orange-600 bg-orange-50 rounded-full mb-4 shadow-sm">Contactez-nous</span>
            <h2 class="section-title text-gray-900">Prenez contact avec nous</h2>
            <p class="text-xl text-gray-600 mt-6 max-w-3xl mx-auto">
                Notre équipe est à votre disposition pour répondre à toutes vos questions et vous accompagner dans votre expérience AutoPrestige.
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
            <!-- Formulaire de contact -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 hover:shadow-2xl">
                <div class="p-1 bg-gradient-to-r from-orange-500 via-amber-500 to-green-600">
                    <div class="bg-white p-8 md:p-10">
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Envoyez-nous un message</h3>
                        <p class="text-gray-500 mb-8">Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</p>
                        
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1.5">Prénom <span class="text-orange-600">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" id="first-name" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent" placeholder="Votre prénom" required>
                                    </div>
                                </div>
                                <div class="group">
                                    <label for="last-name" class="block text-sm font-medium text-gray-700 mb-1.5">Nom <span class="text-orange-600">*</span></label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" id="last-name" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent" placeholder="Votre nom" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="group">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email <span class="text-orange-600">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <input type="email" id="email" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent" placeholder="votre@email.com" required>
                                </div>
                            </div>
                            
                            <div class="group">
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1.5">Téléphone</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.21-.502l4.435.74a1 1 0 01.836.949V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                        </svg>
                                    </div>
                                    <input type="tel" id="phone" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent" placeholder="+225 XX XX XX XX">
                                </div>
                            </div>
                            
                            <div class="group">
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1.5">Votre message <span class="text-orange-600">*</span></label>
                                <div class="relative">
                                    <textarea id="message" rows="5" class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent" placeholder="Comment pouvons-nous vous aider ?" required></textarea>
                                </div>
                            </div>
                            
                            <div class="pt-2">
                                <button type="submit" class="w-full btn-primary py-4 px-6 text-lg font-bold transition-all duration-300 transform hover:scale-[1.02]">
                                    <span class="relative z-10 flex items-center justify-center">
                                        <span>Envoyer le message</span>
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Informations de contact -->
            <div class="space-y-6">
                <!-- Carte d'information -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 hover:shadow-2xl">
                    <div class="p-1 bg-gradient-to-r from-green-600 to-green-800">
                        <div class="bg-white p-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Nos coordonnées</h3>
                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-orange-50 p-3 rounded-xl text-orange-600">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold text-gray-900">Adresse</h4>
                                        <p class="mt-1 text-gray-600">Cocody, Abidjan<br>Côte d'Ivoire</p>
                                        <a href="#" class="mt-2 inline-flex items-center text-sm text-orange-600 hover:text-orange-700 font-medium">
                                            <span>Voir sur la carte</span>
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-orange-50 p-3 rounded-xl text-orange-600">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold text-gray-900">Téléphone</h4>
                                        <p class="mt-1 text-2xl font-bold text-orange-600">+225 XX XX XX XX</p>
                                        <p class="mt-1 text-sm text-gray-500">Lun-Ven: 8h-20h | Sam: 9h-18h</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-orange-50 p-3 rounded-xl text-orange-600">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold text-gray-900">Email</h4>
                                        <a href="mailto:contact@autoprestige.ci" class="mt-1 text-orange-600 hover:text-orange-700">contact@autoprestige.ci</a>
                                        <p class="mt-2 text-sm text-gray-500">Réponse sous 24h ouvrées</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-8 pt-6 border-t border-gray-100">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Suivez-nous</h4>
                                <div class="flex space-x-4">
                                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 hover:bg-orange-100 flex items-center justify-center text-gray-600 hover:text-orange-600 transition-colors">
                                        <span class="sr-only">Facebook</span>
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 hover:bg-orange-100 flex items-center justify-center text-gray-600 hover:text-orange-600 transition-colors">
                                        <span class="sr-only">Instagram</span>
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.415-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 hover:bg-orange-100 flex items-center justify-center text-gray-600 hover:text-orange-600 transition-colors">
                                        <span class="sr-only">Twitter</span>
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                        </svg>
                                    </a>
                                    <a href="#" class="w-10 h-10 rounded-full bg-gray-100 hover:bg-orange-100 flex items-center justify-center text-gray-600 hover:text-orange-600 transition-colors">
                                        <span class="sr-only">LinkedIn</span>
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Carte de localisation -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 hover:shadow-2xl">
                    <div class="h-64 bg-gray-100 relative">
                        <div class="absolute inset-0 bg-[url('https://maps.googleapis.com/maps/api/staticmap?center=5.3599,-4.0083&zoom=13&size=600x300&maptype=roadmap&markers=color:red%7C5.3599,-4.0083&key=YOUR_API_KEY')] bg-cover bg-center"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                        <div class="absolute bottom-4 left-0 right-0 text-center">
                            <a href="#" class="inline-flex items-center px-6 py-2.5 bg-white text-gray-800 font-medium rounded-lg shadow-md hover:bg-gray-100 transition-colors">
                                <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Ouvrir dans Google Maps</span>
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Trouvez-nous facilement</h4>
                        <p class="text-gray-600 text-sm">Notre showroom est situé en plein cœur de Cocody, avec un accès facile et un parking sécurisé à votre disposition.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="relative py-20 bg-gradient-to-r from-primary to-blue-600 text-white overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[url('https://www.toptal.com/designers/subtlepatterns/uploads/dot-grid.png')]"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-primary/90 to-blue-600/90"></div>
    </div>
    
    <div class="relative z-10 container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Prêt à vivre l'expérience AutoPrestige ?</h2>
        <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto">
            Découvrez notre sélection exclusive de véhicules de luxe et profitez d'un service personnalisé.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('vehicules') }}" class="bg-white text-primary hover:bg-gray-100 font-bold py-4 px-8 rounded-lg transition-all duration-300 transform hover:scale-105 inline-flex items-center">
                <span class="mr-2">Explorer notre flotte</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
            <a href="#contact" class="bg-transparent border-2 border-white hover:bg-white/10 font-bold py-4 px-8 rounded-lg transition-all duration-300 transform hover:scale-105">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Nous contacter
                </span>
            </a>
        </div>
    </div>
            <div class="text-center mb-16 fade-in-up">
                <span class="inline-block px-4 py-1.5 text-sm font-semibold text-primary bg-primary/10 rounded-full mb-4">N'Gbassiman</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">Faites-nous signe !</h2>
                <div class="w-24 h-1.5 bg-gradient-to-r from-orange-500 to-green-500 mx-auto rounded-full"></div>
                <p class="text-lg text-gray-600 mt-6 max-w-2xl mx-auto">
                    Notre équipe est là pour toi, prête à t'écouter et à t'accompagner pour que tu kiffes ta location de bagnole de luxe en Côte d'Ivoire. On est à ton écoute, fais-nous signe !
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="fade-in-up">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Informations de contact</h3>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-primary/10 text-primary">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 8 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">Adresse</h4>
                                <p class="mt-1 text-gray-600">Rue des Jardins, Cocody<br>En face du Lycée Technique, Abidjan<br>Côte d'Ivoire</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-primary/10 text-primary">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">Email</h4>
                                <p class="mt-1 text-gray-600">contact@autoprestige.ci</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-primary/10 text-primary">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">Téléphone</h4>
                                <p class="mt-1 text-gray-600">
                                    <span class="block">+225 07 49 85 63 21 (Appel/WhatsApp)</span>
                                    <span class="block">+225 27 20 21 22 23 (Service Client)</span>
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-primary/10 text-primary">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">Heures d'ouverture</h4>
                                <p class="mt-1 text-gray-600">
                                    <span class="block">Lundi - Vendredi: 7h30 - 19h</span>
                                    <span class="block">Samedi: 8h - 18h</span>
                                    <span class="block">Dimanche: 9h - 13h (Service limité)</span>
                                    <span class="text-sm text-amber-600">*Fermé les jours fériés</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-12">
                        <h4 class="text-xl font-bold text-gray-900 mb-6">Viens faire un tour sur nos réseaux</h4>
                        <div class="flex flex-wrap gap-3">
                            <a href="#" class="h-12 px-4 rounded-full bg-[#3b5998] hover:bg-[#2d4373] text-white font-medium flex items-center gap-2 transition-colors duration-300">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                </svg>
                                <span>Facebook</span>
                            </a>
                            <a href="#" class="h-12 px-4 rounded-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-medium flex items-center gap-2 transition-colors duration-300">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63z" clip-rule="evenodd" />
                                </svg>
                                <span>Instagram</span>
                            </a>
                            <a href="#" class="h-12 px-4 rounded-full bg-[#25D366] hover:bg-[#128C7E] text-white font-medium flex items-center gap-2 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M17.498 14.382v-.065c0-2.746-6-4.317-6-9.917C11.498 2.5 10.542 1 8.5 1c-2 0-3 1.5-3 3.4 0 6.5 5.5 10.982 9 10.982 1 0 2-1 2-2v-1.5c0-.5-.5-1-1-1h-1v-2c0-1 .5-1 1-1h3c.5 0 1 .5 1 1v3.5c0 .5.5 1 1 1h2c.5 0 1-.5 1-1v-3.5c0-1.5-1.5-2.5-3-2.5h-1v-1.5c0-.5.5-1 1-1h1.5c2.5 0 4 1.5 4 4.5z"/>
                                </svg>
                                <span>WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-xl p-8 fade-in-up animate-delay-200">
                    <div class="flex items-center gap-3 mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Laisse-nous un message</h3>
                        <span class="text-sm px-3 py-1 bg-orange-100 text-orange-800 rounded-full">On te répond en moins de 24h</span>
                    </div>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1.5">Prénom</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-gray-400">person</span>
                                    </div>
                                    <input type="text" id="first_name" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300" placeholder="Votre prénom">
                                </div>
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1.5">Nom</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-gray-400">person</span>
                                    </div>
                                    <input type="text" id="last_name" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300" placeholder="Votre nom">
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400">email</span>
                                </div>
                                <input type="email" id="email" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300" placeholder="votre@email.com">
                            </div>
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1.5">Sujet</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400">subject</span>
                                </div>
                                <select id="subject" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300 appearance-none bg-white">
                                    <option value="" disabled selected>Choisissez un motif</option>
                                    <option value="location">Demande de location</option>
                                    <option value="devis">Demande de devis</option>
                                    <option value="info">Renseignement</option>
                                    <option value="reclamation">Réclamation</option>
                                    <option value="partenariat">Partenariat</option>
                                    <option value="autre">Autre</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="material-symbols-outlined text-gray-400">expand_more</span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1.5">Message</label>
                            <div class="relative">
                                <div class="absolute top-3 left-3">
                                    <span class="material-symbols-outlined text-gray-400">message</span>
                                </div>
                                <textarea id="message" rows="4" class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300" placeholder="Dites-nous tout..."></textarea>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="privacy" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded transition-all duration-300">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="privacy" class="text-gray-600">
                                    En soumettant ce formulaire, j'accepte que mes données soient utilisées pour me recontacter. <a href="#" class="text-primary hover:underline font-medium">Politique de confidentialité</a>
                                </label>
                            </div>
                        </div>
                        
                        <div class="relative group">
                            <div class="absolute -inset-1 bg-gradient-to-r from-orange-500 to-green-500 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-300"></div>
                            <button type="submit" class="relative w-full bg-gradient-to-r from-primary to-green-600 hover:from-green-600 hover:to-primary text-white font-bold py-4 px-6 rounded-lg transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                                <span>Envoyer le message</span>
                                <span class="material-symbols-outlined">send</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Carte Google Maps -->
<div class="h-96 w-full relative">
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/30 to-transparent z-10"></div>
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.093162042823!2d-3.990635684734717!3d5.359891996105398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ebbb5d1a85f9%3A0x8f8c9e1e3c1b2b0a!2sAbidjan%2C%20C%C3%B4te%20d%27Ivoire!5e0!3m2!1sfr!2sfr!4v1620000000000!5m2!1sfr!2sfr" 
        width="100%" 
        height="100%" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy"
        class="dark:grayscale-[50%]">
    </iframe>
</div>

<!-- Newsletter Section -->
<section class="bg-gray-50 py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0 bg-[url('https://www.toptal.com/designers/subtlepatterns/uploads/dot-grid.png')]"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block px-4 py-1.5 text-sm font-semibold text-primary bg-primary/10 rounded-full mb-6">
                Restez informé
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-4">Abonnez-vous à notre newsletter</h3>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Recevez nos dernières offres exclusives et actualités directement dans votre boîte de réception.
            </p>
            
            <form class="max-w-md mx-auto">
                <div class="flex flex-col sm:flex-row gap-4">
                    <input type="email" 
                           placeholder="Votre adresse email" 
                           class="flex-1 px-6 py-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-300"
                           required>
                    <button type="submit" class="bg-gradient-to-r from-primary to-blue-700 hover:from-blue-700 hover:to-primary text-white font-bold py-4 px-8 rounded-lg transition-all duration-300 transform hover:scale-105 whitespace-nowrap">
                        S'abonner
                    </button>
                </div>
                <p class="mt-3 text-sm text-gray-500">
                    Nous respectons votre vie privée. Désabonnez-vous à tout moment.
                </p>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Animation au défilement
    document.addEventListener('DOMContentLoaded', function() {
        const fadeElements = document.querySelectorAll('.fade-in-up');
        
        const fadeInOnScroll = () => {
            fadeElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (elementTop < windowHeight - 100) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };
        
        // Initial state
        fadeElements.forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        });
        
        // Check on load
        fadeInOnScroll();
        
        // Check on scroll
        window.addEventListener('scroll', fadeInOnScroll);
    });
</script>
@endpush
@endsection