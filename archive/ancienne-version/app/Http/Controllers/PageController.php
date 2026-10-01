<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Liste des véhicules disponibles
     *
     * @var array
     */
    protected $vehicules = [
        [
            'id' => 1,
            'modele' => 'Mercedes Classe S 500',
            'prix' => 250000,
            'image' => 'https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'images' => [
                'https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1580273916551-e352023c546e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1636461402302-426f0c1b6035?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            'categorie' => 'Berline de Luxe',
            'annee' => 2024,
            'carburant' => 'Hybride Rechargeable',
            'boite' => 'Automatique 9G-TRONIC',
            'places' => 5,
            'puissance' => '435 ch',
            'acceleration' => '4.9s (0-100 km/h)',
            'consommation' => '1.5L/100km',
            'kilometrage' => '15 200 km',
            'equipements' => ['Siège massant', 'Toit panoramique', 'Système audio Burmester', 'Écrans arrière', 'Climatisation 4 zones']
        ],
        [
            'id' => 2,
            'modele' => 'Range Rover Vogue',
            'prix' => 180000,
            'image' => 'https://images.unsplash.com/photo-1580273916551-e352023c546e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'images' => [
                'https://images.unsplash.com/photo-1580273916551-e352023c546e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1636461402302-426f0c1b6035?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            'categorie' => 'SUV de Luxe',
            'annee' => 2024,
            'carburant' => 'Diesel',
            'boite' => 'Automatique 8 vitesses',
            'places' => 5,
            'puissance' => '350 ch',
            'acceleration' => '6.3s (0-100 km/h)',
            'consommation' => '7.8L/100km',
            'kilometrage' => '22 500 km',
            'equipements' => ['Intérieur cuir Windsor', 'Système audio Meridian', 'Suspension pneumatique', 'Toit panoramique', 'Sièges chauffants/ventilés']
        ],
        [
            'id' => 3,
            'modele' => 'Porsche 911 Carrera S',
            'prix' => 320000,
            'image' => 'https://images.unsplash.com/photo-1503376785-2acd72611164?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'images' => [
                'https://images.unsplash.com/photo-1503376785-2acd72611164?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1580273916551-e352023c546e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            'categorie' => 'Sportive',
            'annee' => 2024,
            'carburant' => 'Essence',
            'boite' => 'PDK 8 vitesses',
            'places' => 4,
            'puissance' => '450 ch',
            'acceleration' => '3.5s (0-100 km/h)',
            'consommation' => '9.0L/100km',
            'kilometrage' => '12 300 km',
            'equipements' => ['Sièges sport 18 réglages', 'Châssis sport', 'Échappement sport', 'Jantes alliage 20"', 'Système audio Bose']
        ],
        [
            'id' => 4,
            'modele' => 'Toyota Land Cruiser',
            'prix' => 120000,
            'image' => 'https://images.unsplash.com/photo-1631526090968-6979b72f2ce2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'images' => [
                'https://images.unsplash.com/photo-1631526090968-6979b72f2ce2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1580273916551-e352023c546e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            'categorie' => '4x4',
            'annee' => 2024,
            'carburant' => 'Diesel',
            'boite' => 'Automatique 10 vitesses',
            'places' => 7,
            'puissance' => '286 ch',
            'acceleration' => '8.0s (0-100 km/h)',
            'consommation' => '8.9L/100km',
            'kilometrage' => '25 100 km',
            'equipements' => ['4x4 permanent', '3ème rangée de sièges', 'Suspension adaptative', 'Jantes 18" alliage', 'Système multimédia']
        ],
        [
            'id' => 5,
            'modele' => 'BMW Série 7',
            'prix' => 200000,
            'image' => 'https://images.unsplash.com/photo-1617704548623-340376564e68?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'images' => [
                'https://images.unsplash.com/photo-1617704548623-340376564e68?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1580273916551-e352023c546e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            'categorie' => 'Berline Prestige',
            'annee' => 2024,
            'carburant' => 'Hybride Rechargeable',
            'boite' => 'Automatique 8 vitesses',
            'places' => 5,
            'puissance' => '400 ch',
            'acceleration' => '4.7s (0-100 km/h)',
            'consommation' => '1.8L/100km',
            'kilometrage' => '18 200 km',
            'equipements' => ['Écran tactile 12.3"', 'Toit panoramique', 'Sièges chauffants', 'Climatisation 4 zones', 'Système audio Harman Kardon']
        ],
        [
            'id' => 6,
            'modele' => 'Lexus LX 600',
            'prix' => 190000,
            'image' => 'https://images.unsplash.com/photo-1636461402302-426f0c1b6035?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'images' => [
                'https://images.unsplash.com/photo-1636461402302-426f0c1b6035?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1580273916551-e352023c546e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
            ],
            'categorie' => 'SUV Luxe',
            'annee' => 2024,
            'carburant' => 'Essence',
            'boite' => 'Automatique 10 vitesses',
            'places' => 7,
            'puissance' => '409 ch',
            'acceleration' => '6.9s (0-100 km/h)',
            'consommation' => '10.8L/100km',
            'kilometrage' => '18 750 km',
            'equipements' => ['Intérieur cuir semi-aniliné', 'Système audio Mark Levinson', '4 roues directrices', 'Suspension adaptative', 'Écrans arrière']
        ]
    ];
    public function acceuil()
    {
        return view('acceuil');
    }

    public function apropos()
    {
        return view('apropos');
    }

    public function desVehicules()
    {
        // Filtrer pour ne garder que les véhicules avec une image
        $vehicules = array_filter($this->vehicules, function($vehicule) {
            return !empty($vehicule['image']);
        });
        
        // Réindexer le tableau pour éviter les trous dans les indices
        $vehicules = array_values($vehicules);
        
        return view('desvehicules', compact('vehicules'));
    }

    /**
     * Dictionnaire des descriptions détaillées par modèle
     *
     * @var array
     */
    protected $descriptions = [
        'Porsche 911 Carrera S' => [
            'introduction' => 'La Porsche 911 Carrera S, icône intemporelle de la marque allemande, allie performance pure et élégance sportive. Avec son moteur boxer 6 cylindres de 450 chevaux, elle offre une expérience de conduite inégalable.',
            'caracteristiques' => [
                'Moteur boxer 6 cylindres à plat de 3.0L bi-turbo',
                'Boîte PDK à double embrayage 8 rapports',
                'Système de traction intégrale intégrale Porsche (PTM)',
                'Direction précise à assistance variable',
                'Freins céramique Porsche Ceramic Composite Brake (PCCB) en option'
            ],
            'interieur' => 'L\'intérieur allie luxe et sportivité avec des sièges sport 18 réglables, des matériaux haut de gamme et une position de conduite basse et enveloppante. Le volant sport multifonction à fond plat et les pédales en aluminium massif rappellent l\'héritage sportif de la marque.',
            'confort' => 'Malgré ses performances, la 911 Carrera S offre un confort quotidien avec sa suspension adaptative et son insonorisation soignée. Le système multimédia Porsche Communication Management (PCM) avec écran tactile de 10,9" et la connectivité complète assurent un voyage agréable.'
        ],
        'Range Rover Vogue' => [
            'introduction' => 'Le Range Rover Vogue incarne l\'excellence du luxe tout-terrain avec un raffinement inégalé. Ce SUV haut de gamme allie prestance britannique et capacités hors route exceptionnelles.',
            'caracteristiques' => [
                'Moteur V8 suralimenté de 4.4L',
                'Transmission intégrale permanente avec réducteur de gamme',
                'Suspension pneumatique à hauteur variable',
                'Système Terrain Response 2 avec mode automatique',
                'Freinage régénératif et assistance au démarrage en côte'
            ],
            'interieur' => 'L\'habitacle est un véritable salon sur roues avec des sièges en cuir Windsor massif, des finitions en bois précieux et métal brossé. L\'espace généreux et la position de conduite surélevée offrent une vue imprenable sur la route.',
            'confort' => 'Le Vogue propose un niveau de confort inégalé avec sa suspension pneumatique à correction d\'assiette, sa climatisation 4 zones et son système audio Meridian Signature à 29 haut-parleurs. Les vitres acoustiques et l\'insonorisation poussée assurent une ambiance feutrée.'
        ],
        'Tesla Model S' => [
            'introduction' => 'La Tesla Model S redéfinit les standards des berlines électriques avec ses performances exceptionnelles et son autonomie record. Ce véhicule 100% électrique allie technologie de pointe et élégance discrète.',
            'caracteristiques' => [
                'Batterie Long Range ou Plaid selon version',
                'Autonomie allant jusqu\'à 652 km (WLTP)',
                'Accélération de 0 à 100 km/h en 1,99s (Plaid)',
                'Système de conduite autonome avancé',
                'Recharge rapide Supercharger V3'
            ],
            'interieur' => 'L\'habitacle minimaliste est dominé par un écran tactile de 17" orientable et un tableau de bord numérique. L\'espace est optimisé grâce à l\'absence de tunnel central, offrant un grand coffre avant et arrière.',
            'confort' => 'Le système de filtration HEPA, la climatisation intelligente et l\'insonorisation de qualité supérieure créent une bulle de confort. Le système audio Premium à 22 haut-parleurs et la connexion permanente à Internet offrent une expérience multimédia complète.'
        ],
        'default' => [
            'introduction' => 'Ce véhicule d\'exception allie performance et élégance pour une expérience de conduite inoubliable. Son design soigné et ses technologies de pointe en font un compagnon idéal pour tous vos déplacements.',
            'caracteristiques' => [
                'Moteur performant et économe',
                'Boîte de vitesses automatique à 8 rapports',
                'Système de navigation et multimédia avancé',
                'Aides à la conduite et sécurité active',
                'Confort et espace optimisés'
            ],
            'interieur' => 'L\'habitacle allie confort et technologie avec des matériaux de qualité et une ergonomie soignée. L\'espace est optimisé pour tous les passagers, avec des rangements pratiques et un coffre spacieux.',
            'confort' => 'Les équipements haut de gamme et l\'insonorisation poussée assurent un voyage agréable en toutes circonstances. La climatisation automatique multi-zones et les sièges réglables électriquement contribuent au bien-être à bord.'
        ]
    ];

    public function detailDesVehicules($id = null)
    {
        // Si aucun ID n'est fourni, on prend le premier véhicule par défaut
        $vehicule = $id 
            ? collect($this->vehicules)->firstWhere('id', (int)$id) 
            : $this->vehicules[0];
        
        if (!$vehicule) {
            abort(404, 'Véhicule non trouvé');
        }

        // Ajouter la description spécifique au véhicule
        $modele = $vehicule['modele'];
        $vehicule['description'] = $this->descriptions[$modele] ?? $this->descriptions['default'];

        return view('detaildesvehicules', ['vehicule' => $vehicule]);
    }

    public function contact()
    {
        return view('contact');
    }

    public function panier()
    {
        return view('panier');
    }

    public function paiement()
    {
        return view('paiement');
    }

    public function confirmation()
    {
        return view('confirmation');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function monCompte()
    {
        return view('moncompte');
    }

    /**
     * Handle hero video upload (stores on the default disk and redirects to homepage with video URL).
     */
    public function uploadHeroVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,webm,mov|max:512000',
        ]);

        $path = $request->file('video')->store('public/hero_videos');
        $url = Storage::url($path);

        // Redirect to homepage with the uploaded video URL as query parameter
        return redirect()->route('accueil', ['video' => $url])->with('success', 'Vidéo uploadée avec succès !');
    }
}
