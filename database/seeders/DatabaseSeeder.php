<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\ContactMessage;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Données de démonstration : comptes, catégories, flotte de véhicules et quelques réservations.
     */
    public function run(): void
    {
        $admin = new User([
            'prenom' => 'Admin', 'nom' => 'AutoPrestige', 'email' => 'admin@autoprestige.ci',
            'telephone' => '+225 07 67 41 87 01', 'ville' => 'Abidjan',
            'password' => env('ADMIN_PASSWORD', 'admin12345'),
        ]);
        $admin->role = 'admin';
        $admin->email_verified_at = now();
        $admin->save();

        $client = User::create([
            'prenom' => 'Awa', 'nom' => 'Koné', 'email' => 'client@demo.ci',
            'telephone' => '+225 05 44 55 66 77', 'ville' => 'Abidjan', 'password' => 'demo12345',
        ]);

        $categories = collect([
            ['nom' => 'SUV & 4x4', 'slug' => 'suv', 'icone' => 'airport_shuttle', 'description' => 'Spacieux et robustes, pour la ville comme pour l\'intérieur du pays.'],
            ['nom' => 'Berlines', 'slug' => 'berlines', 'icone' => 'directions_car', 'description' => 'Confort et élégance pour vos rendez-vous d\'affaires.'],
            ['nom' => 'Sportives', 'slug' => 'sportives', 'icone' => 'sports_score', 'description' => 'Pour les grandes occasions : mariages, anniversaires, tournages.'],
            ['nom' => 'Électriques & hybrides', 'slug' => 'electriques', 'icone' => 'ev_station', 'description' => 'Silencieuses et économiques.'],
            ['nom' => 'Citadines', 'slug' => 'citadines', 'icone' => 'local_taxi', 'description' => 'Petites et pratiques pour circuler dans Abidjan.'],
        ])->mapWithKeys(fn ($c, $i) => [$c['slug'] => Categorie::create([...$c, 'ordre_affichage' => $i])]);

        $flotte = [
            ['suv', 'Ford', 'Expedition', 2022, 95000, 'essence', 'automatique', 7, '400 ch', 'ford-expedition', 'Grand SUV 7 places, idéal pour les familles et les voyages vers Yamoussoukro ou San Pedro.', ['Climatisation', 'GPS', 'Caméra de recul', '7 places', 'Bluetooth'], true, 31],
            ['suv', 'Toyota', 'RAV4 Hybride', 2023, 55000, 'hybride', 'automatique', 5, '222 ch', 'toyota-rav4', 'SUV hybride fiable et économique, parfait au quotidien.', ['Climatisation', 'Apple CarPlay', 'Caméra de recul', 'Régulateur de vitesse'], true, 44],
            ['suv', 'Honda', 'CR-V', 2021, 45000, 'essence', 'automatique', 5, '190 ch', 'honda-crv', 'SUV confortable avec un grand coffre.', ['Climatisation', 'Bluetooth', 'Régulateur de vitesse'], false, 27],
            ['berlines', 'BMW', 'M5', 2022, 120000, 'essence', 'automatique', 5, '625 ch', 'bmw-m5', 'Berline de prestige alliant confort et performances.', ['Climatisation bi-zone', 'Sièges cuir', 'GPS', 'Toit ouvrant', 'Son Harman Kardon'], true, 18],
            ['berlines', 'BMW', 'Série 4 Coupé', 2021, 85000, 'essence', 'automatique', 4, '258 ch', 'bmw-serie4', 'Coupé élégant pour vos sorties et rendez-vous.', ['Climatisation', 'Sièges cuir', 'GPS', 'Bluetooth'], false, 15],
            ['electriques', 'Tesla', 'Model 3', 2023, 70000, 'electrique', 'automatique', 5, '283 ch', 'tesla-model3', '100 % électrique, autonomie de 500 km. Recharge offerte à l\'agence.', ['Pilote automatique', 'Écran 15 pouces', 'Toit panoramique', 'Climatisation'], true, 22],
            ['sportives', 'Mercedes-AMG', 'GT', 2021, 250000, 'essence', 'automatique', 2, '530 ch', 'mercedes-amg-gt', 'La voiture des grandes occasions : mariages, anniversaires, clips vidéo.', ['Sièges sport', 'Son Burmester', 'Mode Race', 'Climatisation'], true, 9],
            ['sportives', 'Ford', 'Mustang GT', 2022, 150000, 'essence', 'automatique', 4, '450 ch', 'ford-mustang', 'Le mythe américain et son V8 pour une expérience inoubliable.', ['V8', 'Sièges cuir', 'Climatisation', 'Bluetooth'], false, 12],
            ['sportives', 'Chevrolet', 'Camaro SS', 2021, 140000, 'essence', 'automatique', 4, '455 ch', 'chevrolet-camaro', 'Muscle car au caractère affirmé, parfaite pour un événement.', ['V8', 'Affichage tête haute', 'Climatisation'], false, 8],
            ['citadines', 'Fiat', '500', 2022, 25000, 'essence', 'manuelle', 4, '70 ch', 'fiat-500', 'Petite, économique et facile à garer en ville.', ['Climatisation', 'Bluetooth'], false, 53],
        ];

        $vehicules = [];
        foreach ($flotte as [$cat, $marque, $modele, $annee, $prix, $carburant, $boite, $places, $puissance, $image, $courte, $equipements, $vedette, $locations]) {
            $vehicules[$image] = Vehicule::create([
                'categorie_id' => $categories[$cat]->id,
                'marque' => $marque, 'modele' => $modele, 'annee' => $annee,
                'prix_journalier' => $prix, 'caution' => $prix * 5,
                'carburant' => $carburant, 'boite' => $boite, 'places' => $places, 'puissance' => $puissance,
                'image' => "images/vehicules/{$image}.jpg",
                'description_courte' => $courte,
                'description' => $courte . "\n\nVéhicule entretenu dans notre atelier, assuré tous risques. Kilométrage illimité dans le Grand Abidjan. Option chauffeur disponible.",
                'equipements' => $equipements,
                'est_en_vedette' => $vedette,
                'nombre_locations' => $locations,
            ]);
        }

        // Réservations de démonstration pour le client
        $reservations = [
            ['toyota-rav4', 5, 8, 'confirmee', 'aeroport', false, 'wave'],
            ['mercedes-amg-gt', 20, 20, 'en_attente', 'agence', true, 'orange_money'],
            ['fiat-500', -15, -12, 'terminee', 'agence', false, 'especes'],
        ];
        foreach ($reservations as [$image, $debut, $fin, $statut, $lieu, $chauffeur, $paiement]) {
            $v = $vehicules[$image];
            $dDebut = now()->addDays($debut)->toDateString();
            $dFin = now()->addDays($fin)->toDateString();
            Reservation::create([
                ...Reservation::calculer($v, $dDebut, $dFin, $chauffeur, $lieu),
                'user_id' => $client->id, 'vehicule_id' => $v->id,
                'date_debut' => $dDebut, 'date_fin' => $dFin,
                'lieu_prise_en_charge' => $lieu, 'avec_chauffeur' => $chauffeur,
                'mode_paiement' => $paiement, 'telephone' => $client->telephone,
                'statut' => $statut, 'date_confirmation' => $statut === 'confirmee' ? now() : null,
            ]);
        }

        ContactMessage::create([
            'nom' => 'Serge N\'Guessan', 'email' => 'serge@example.ci', 'telephone' => '+225 01 02 03 04 05',
            'sujet' => 'Mariage en décembre',
            'message' => 'Bonjour, je souhaite louer deux véhicules avec chauffeur pour un mariage le 20 décembre à Cocody. Quel serait votre tarif ?',
        ]);
    }
}
