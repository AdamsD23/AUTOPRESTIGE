<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        // Créer une réservation pour l'utilisateur admin
        $admin = User::where('email', 'admin@example.com')->first();
        $vehicule = Vehicule::first();

        if ($admin && $vehicule) {
            $dateDebut = Carbon::now()->addDays(5);
            $dateFin = $dateDebut->copy()->addDays(7);
            $prixJournalier = 100;
            $nombreJours = $dateDebut->diffInDays($dateFin);
            $sousTotal = $prixJournalier * $nombreJours;
            $fraisService = $sousTotal * 0.10; // 10% de frais de service
            $taxes = $sousTotal * 0.20; // 20% de TVA
            $prixTotal = $sousTotal + $fraisService + $taxes;
            $dateNaissanceConducteur = Carbon::now()->subYears(30);
            $dateDelivrancePermis = Carbon::now()->subYears(10);

            Reservation::create([
                // Identifiant et référence
                'reference' => 'RES-' . strtoupper(Str::random(8)),
                'user_id' => $admin->id,
                'vehicule_id' => $vehicule->id,
                
                // Période de location
                'date_debut' => $dateDebut,
                'date_fin' => $dateFin,
                'heure_debut' => '14:00:00',
                'heure_fin' => '12:00:00',
                
                // Prix et paiement
                'prix_journalier' => $prixJournalier,
                'nombre_jours' => $nombreJours,
                'sous_total' => $sousTotal,
                'frais_service' => $fraisService,
                'taxes' => $taxes,
                'reduction' => 0,
                'prix_total' => $prixTotal,
                'montant_acompte' => $prixTotal * 0.30, // 30% d'acompte
                'solde_a_payer' => $prixTotal * 0.70, // 70% de solde
                'statut' => 'confirmee',
                'date_limite_paiement' => $dateDebut->copy()->subDays(2),
                
                // Informations du conducteur (champs obligatoires)
                'nom_conducteur' => $admin->nom,
                'prenom_conducteur' => $admin->prenom,
                'email_conducteur' => $admin->email,
                'telephone_conducteur' => $admin->telephone,
                'date_naissance_conducteur' => $dateNaissanceConducteur->format('Y-m-d'),
                'numero_permis' => 'PERMIS' . strtoupper(Str::random(8)),
                'date_delivrance_permis' => $dateDelivrancePermis->format('Y-m-d'),
                
                // Lieux de prise et retour (champs obligatoires)
                'lieu_prise_en_charge' => 'Bureau principal',
                'lieu_retour' => 'Bureau principal',
                
                // Kilométrage et carburant (champs obligatoires)
                'kilometrage_depart' => 15000,
                'niveau_carburant_depart' => 'plein',
            ]);
        }
    }
}
