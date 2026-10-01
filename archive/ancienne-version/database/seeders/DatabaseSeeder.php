<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création des utilisateurs
        $this->call([
            AdminUserSeeder::class,
        ]);

        // Création d'un utilisateur de test avec tous les champs requis
        $user = User::create([
            'prenom' => 'Test',
            'nom' => 'User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'telephone' => '0123456789',
            'adresse' => '123 Test Street',
            'ville' => 'Test City',
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Création d'une catégorie de test
        $categorie = \App\Models\Categorie::create([
            'nom' => 'Citadine',
            'slug' => 'citadine',
            'description' => 'Véhicules compacts et économiques, parfaits pour la ville',
            'icone' => 'car-side',
            'est_actif' => true,
        ]);

        // Création de véhicules de test
        $vehicule = \App\Models\Vehicule::create([
            'categorie_id' => $categorie->id,
            'modele' => 'Peugeot 208',
            'slug' => 'peugeot-208',
            'prix_journalier' => 50,
            'image_principale' => 'https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
            'annee' => 2023,
            'kilometrage' => 15000,
            'carburant' => 'Essence',
            'boite' => 'Manuelle',
            'places' => 5,
            'portes' => 5,
            'couleur' => 'Bleu',
            'puissance' => '100 ch',
            'consommation' => '5.5 L/100km',
            'est_disponible' => true,
            'est_actif' => true,
            'description_courte' => 'Voiture compacte idéale pour la ville',
            'description_longue' => 'La Peugeot 208 est une citadine compacte et élégante, parfaite pour les déplacements en ville avec un excellent rapport qualité-prix.',
            'equipements' => json_encode(['Climatisation', 'GPS', 'Bluetooth']),
            'options' => json_encode(['Toit ouvrant', 'Caméra de recul']),
            'ville' => 'Paris',
            'adresse' => '123 Avenue des Champs-Élysées',
        ]);

        // Création des réservations de test
        $this->call([
            ReservationSeeder::class,
        ]);
    }
}
