<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_id')->constrained()->cascadeOnDelete();
            $table->string('marque', 60);
            $table->string('modele', 100);
            $table->string('slug')->unique();
            $table->unsignedSmallInteger('annee');
            $table->unsignedInteger('prix_journalier'); // en FCFA
            $table->unsignedInteger('caution')->default(0); // en FCFA
            $table->string('carburant', 20); // essence, diesel, hybride, electrique
            $table->string('boite', 20); // automatique, manuelle
            $table->unsignedTinyInteger('places');
            $table->string('puissance', 30)->nullable();
            $table->string('image');
            $table->string('description_courte');
            $table->text('description')->nullable();
            $table->json('equipements')->nullable();
            $table->boolean('est_disponible')->default(true);
            $table->boolean('est_en_vedette')->default(false);
            $table->unsignedInteger('nombre_locations')->default(0);
            $table->timestamps();

            $table->index(['est_disponible', 'categorie_id']);
            $table->index('prix_journalier');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
