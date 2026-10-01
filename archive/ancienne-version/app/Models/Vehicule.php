<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Vehicule extends Model
{
    use SoftDeletes;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'categorie_id',
        'user_id',
        'modele',
        'slug',
        'prix_journalier',
        'annee',
        'kilometrage',
        'carburant',
        'boite',
        'places',
        'portes',
        'couleur',
        'puissance',
        'consommation',
        'image_principale',
        'galerie',
        'est_disponible',
        'est_en_vedette',
        'est_actif',
        'description_courte',
        'description_longue',
        'equipements',
        'options',
        'transmission',
        'moteur',
        'type_carrosserie',
        'classe_emission',
        'ville',
        'adresse',
        'latitude',
        'longitude',
        'meta_titre',
        'meta_description',
        'mots_cles',
        'date_mise_en_circulation',
        'date_dernier_controle',
        'prochain_controle',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'est_disponible' => 'boolean',
        'est_en_vedette' => 'boolean',
        'est_actif' => 'boolean',
        'galerie' => 'array',
        'equipements' => 'array',
        'options' => 'array',
        'mots_cles' => 'array',
        'date_mise_en_circulation' => 'date',
        'date_dernier_controle' => 'date',
        'prochain_controle' => 'date',
    ];

    /**
     * Les attributs qui doivent être cachés pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Les attributs à ajouter à la représentation JSON du modèle.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'image_url',
        'galerie_urls',
        'est_nouveau',
        'prix_formate',
    ];

    /**
     * Boot le modèle.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($vehicule) {
            $vehicule->slug = Str::slug($vehicule->modele . ' ' . $vehicule->annee);
            
            // Gérer l'unicité du slug
            $originalSlug = $vehicule->slug;
            $count = 1;
            
            while (static::where('slug', $vehicule->slug)->exists()) {
                $vehicule->slug = $originalSlug . '-' . $count++;
            }
        });

        static::updating(function ($vehicule) {
            if ($vehic->isDirty('modele') || $vehicule->isDirty('annee')) {
                $vehicule->slug = Str::slug($vehicule->modele . ' ' . $vehicule->annee);
                
                // Gérer l'unicité du slug
                $originalSlug = $vehicule->slug;
                $count = 1;
                
                while (static::where('slug', $vehicule->slug)
                           ->where('id', '!=', $vehicule->id)
                           ->exists()) {
                    $vehicule->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }

    /**
     * Obtenir la catégorie du véhicule.
     */
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    /**
     * Relation avec l'utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Vérifie si le véhicule est disponible pour une période donnée
     */
    public function estDisponible($dateDebut, $dateFin, $excludeReservationId = null)
    {
        $query = $this->reservations()
            ->whereIn('statut', ['en_attente', 'confirmee', 'en_cours'])
            ->where(function($q) use ($dateDebut, $dateFin) {
                $q->whereBetween('date_debut', [$dateDebut, $dateFin])
                  ->orWhereBetween('date_fin', [$dateDebut, $dateFin])
                  ->orWhere(function($q2) use ($dateDebut, $dateFin) {
                      $q2->where('date_debut', '<=', $dateDebut)
                         ->where('date_fin', '>=', $dateFin);
                  });
            });

        if ($excludeReservationId) {
            $query->where('id', '!=', $excludeReservationId);
        }

        return !$query->exists();
    }

    /**
     * Obtenir le propriétaire du véhicule.
     */
    public function proprietaire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Obtenir les réservations pour ce véhicule.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Obtenir les avis pour ce véhicule.
     */
    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class);
    }

    /**
     * Obtenir les utilisateurs qui ont mis ce véhicule en favori.
     */
    public function favoris(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favoris')
                    ->withTimestamps();
    }

    /**
     * Obtenir l'URL complète de l'image principale.
     */
    public function getImageUrlAttribute(): string
    {
        return $this->image_principale 
            ? asset('storage/vehicules/' . $this->image_principale)
            : asset('images/vehicule-par-defaut.jpg');
    }

    /**
     * Obtenir les URLs complètes des images de la galerie.
     */
    public function getGalerieUrlsAttribute(): array
    {
        if (empty($this->galerie)) {
            return [];
        }

        return array_map(function ($image) {
            return asset('storage/vehicules/galerie/' . $image);
        }, $this->galerie);
    }

    /**
     * Vérifier si le véhicule est considéré comme nouveau (moins de 3 mois).
     */
    public function getEstNouveauAttribute(): bool
    {
        return $this->created_at->diffInMonths(now()) < 3;
    }

    /**
     * Obtenir le prix formaté avec la devise.
     */
    public function getPrixFormateAttribute(): string
    {
        return number_format($this->prix_journalier, 2, ',', ' ') . ' FCFA/jour';
    }

    /**
     * Obtenir la note moyenne du véhicule.
     */
    public function noteMoyenne(): float
    {
        return $this->avis()->avg('note') ?? 0;
    }

    /**
     * Vérifier si le véhicule est disponible pour une période donnée.
     */
    public function estDisponiblePourPeriode($dateDebut, $dateFin): bool
    {
        return !$this->reservations()
            ->where(function ($query) use ($dateDebut, $dateFin) {
                $query->whereBetween('date_debut', [$dateDebut, $dateFin])
                      ->orWhereBetween('date_fin', [$dateDebut, $dateFin])
                      ->orWhere(function ($query) use ($dateDebut, $dateFin) {
                          $query->where('date_debut', '<=', $dateDebut)
                                ->where('date_fin', '>=', $dateFin);
                      });
            })
            ->whereNotIn('statut', ['annulee', 'refusee'])
            ->exists();
    }

    /**
     * Obtenir les véhicules disponibles.
     */
    public function scopeDisponibles($query)
    {
        return $query->where('est_disponible', true)
                    ->where('est_actif', true);
    }

    /**
     * Obtenir les véhicules en vedette.
     */
    public function scopeEnVedette($query)
    {
        return $query->where('est_en_vedette', true)
                    ->disponibles();
    }

    /**
     * Obtenir les véhicules par catégorie.
     */
    public function scopeParCategorie($query, $categorieId)
    {
        return $query->where('categorie_id', $categorieId);
    }

    /**
     * Filtrer les véhicules par prix.
     */
    public function scopePrixEntre($query, $min, $max = null)
    {
        $query->where('prix_journalier', '>=', $min);
        
        if ($max !== null) {
            $query->where('prix_journalier', '<=', $max);
        }
        
        return $query;
    }
}
