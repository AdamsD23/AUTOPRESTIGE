<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Vehicule extends Model
{
    public const CARBURANTS = ['essence' => 'Essence', 'diesel' => 'Diesel', 'hybride' => 'Hybride', 'electrique' => 'Électrique'];
    public const BOITES = ['automatique' => 'Automatique', 'manuelle' => 'Manuelle'];

    protected $fillable = [
        'categorie_id', 'marque', 'modele', 'slug', 'annee', 'prix_journalier', 'caution',
        'carburant', 'boite', 'places', 'puissance', 'image', 'description_courte', 'description',
        'equipements', 'est_disponible', 'est_en_vedette', 'nombre_locations',
    ];

    protected function casts(): array
    {
        return [
            'equipements' => 'array',
            'est_disponible' => 'boolean',
            'est_en_vedette' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Vehicule $vehicule) {
            $vehicule->slug ??= Str::slug("{$vehicule->marque} {$vehicule->modele} {$vehicule->annee}");
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function getNomAttribute(): string
    {
        return "{$this->marque} {$this->modele}";
    }

    public function getImageUrlAttribute(): string
    {
        return Str::startsWith($this->image, ['http://', 'https://']) ? $this->image : asset($this->image);
    }

    public function scopeDisponibles(Builder $query): Builder
    {
        return $query->where('est_disponible', true);
    }

    /**
     * Le véhicule est-il libre sur toute la période ? (réservations en attente ou confirmées)
     */
    public function estLibre(string $debut, string $fin, ?int $saufReservationId = null): bool
    {
        return ! $this->reservations()
            ->whereIn('statut', Reservation::STATUTS_ACTIFS)
            ->when($saufReservationId, fn ($q) => $q->where('id', '!=', $saufReservationId))
            ->whereDate('date_debut', '<=', $fin)
            ->whereDate('date_fin', '>=', $debut)
            ->exists();
    }
}
