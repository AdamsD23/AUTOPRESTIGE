<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 20)->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vehicule_id')->constrained()->cascadeOnDelete();

            $table->date('date_debut');
            $table->date('date_fin');
            $table->unsignedSmallInteger('nombre_jours');
            $table->string('lieu_prise_en_charge', 30); // agence, aeroport, domicile
            $table->string('adresse_livraison')->nullable();
            $table->boolean('avec_chauffeur')->default(false);

            // Montants en FCFA, figés au moment de la réservation
            $table->unsignedInteger('prix_journalier');
            $table->unsignedInteger('frais_chauffeur')->default(0);
            $table->unsignedInteger('frais_livraison')->default(0);
            $table->unsignedInteger('prix_total');

            $table->string('mode_paiement', 20); // wave, orange_money, especes
            $table->string('telephone', 20);
            $table->text('commentaires')->nullable();
            $table->string('statut', 20)->default('en_attente'); // en_attente, confirmee, refusee, annulee, terminee
            $table->timestamp('date_confirmation')->nullable();
            $table->timestamp('date_annulation')->nullable();
            $table->timestamps();

            $table->index(['vehicule_id', 'statut', 'date_debut', 'date_fin']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
