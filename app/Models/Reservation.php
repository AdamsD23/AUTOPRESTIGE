<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Reservation extends Model
{
    /** Tarifs des options (FCFA) */
    public const FRAIS_CHAUFFEUR_PAR_JOUR = 25000;
    public const FRAIS_LIVRAISON = ['agence' => 0, 'aeroport' => 10000, 'domicile' => 15000];

    public const LIEUX = [
        'agence' => 'Agence AutoPrestige (Cocody Riviera)',
        'aeroport' => 'Aéroport Félix-Houphouët-Boigny',
        'domicile' => 'Livraison à mon adresse',
    ];
    public const PAIEMENTS = ['wave' => 'Wave', 'orange_money' => 'Orange Money', 'especes' => 'Espèces à la remise du véhicule'];
    public const STATUTS = [
        'en_attente' => 'En attente de confirmation',
        'confirmee' => 'Confirmée',
        'refusee' => 'Refusée',
        'annulee' => 'Annulée',
        'terminee' => 'Terminée',
    ];
    /** Statuts qui bloquent le véhicule sur la période */
    public const STATUTS_ACTIFS = ['en_attente', 'confirmee'];

    protected $fillable = [
        'reference', 'user_id', 'vehicule_id', 'date_debut', 'date_fin', 'nombre_jours',
        'lieu_prise_en_charge', 'adresse_livraison', 'avec_chauffeur',
        'prix_journalier', 'frais_chauffeur', 'frais_livraison', 'prix_total',
        'mode_paiement', 'telephone', 'commentaires', 'statut', 'date_confirmation', 'date_annulation',
    ];

    protected function casts(): array
    {
        return [
            'date_debut' => 'date',
            'date_fin' => 'date',
            'avec_chauffeur' => 'boolean',
            'date_confirmation' => 'datetime',
            'date_annulation' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Reservation $reservation) {
            $reservation->reference ??= 'AP-' . strtoupper(Str::random(6));
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicule(): BelongsTo
    {
        return $this->belongsTo(Vehicule::class);
    }

    /**
     * Calcule le détail du prix d'une location (utilisé par le formulaire et à l'enregistrement).
     */
    public static function calculer(Vehicule $vehicule, string $debut, string $fin, bool $chauffeur, string $lieu): array
    {
        // Du jour de départ au jour de retour inclus
        $jours = Carbon::parse($debut)->diffInDays(Carbon::parse($fin)) + 1;
        $fraisChauffeur = $chauffeur ? self::FRAIS_CHAUFFEUR_PAR_JOUR * $jours : 0;
        $fraisLivraison = self::FRAIS_LIVRAISON[$lieu] ?? 0;

        return [
            'nombre_jours' => (int) $jours,
            'prix_journalier' => $vehicule->prix_journalier,
            'frais_chauffeur' => $fraisChauffeur,
            'frais_livraison' => $fraisLivraison,
            'prix_total' => $vehicule->prix_journalier * $jours + $fraisChauffeur + $fraisLivraison,
        ];
    }

    public function getStatutLibelleAttribute(): string
    {
        return self::STATUTS[$this->statut] ?? $this->statut;
    }

    public function getStatutCouleurAttribute(): string
    {
        return match ($this->statut) {
            'confirmee' => 'bg-emerald-100 text-emerald-800',
            'en_attente' => 'bg-amber-100 text-amber-800',
            'terminee' => 'bg-slate-100 text-slate-700',
            default => 'bg-red-100 text-red-700',
        };
    }

    public function estAnnulable(): bool
    {
        return in_array($this->statut, self::STATUTS_ACTIFS, true) && $this->date_debut->isFuture();
    }
}
