<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Reservation extends Model
{
    use SoftDeletes;

    /**
     * Les statuts possibles d'une réservation.
     *
     * @var array
     */
    const STATUTS = [
        'en_attente' => 'En attente',
        'confirmee' => 'Confirmée',
        'en_cours' => 'En cours',
        'terminee' => 'Terminée',
        'annulee' => 'Annulée',
        'refusee' => 'Refusée'
    ];

    /**
     * Les statuts de paiement possibles.
     *
     * @var array
     */
    const STATUTS_PAIEMENT = [
        'en_attente' => 'En attente',
        'partiel' => 'Paiement partiel',
        'paye' => 'Payé',
        'rembourse' => 'Remboursé',
        'echec' => 'Échec de paiement'
    ];

    /**
     * Les modes de paiement possibles.
     *
     * @var array
     */
    const MODES_PAIEMENT = [
        'espece' => 'Espèces',
        'carte_credit' => 'Carte de crédit',
        'virement' => 'Virement bancaire',
        'mobile_money' => 'Mobile Money',
        'autre' => 'Autre'
    ];

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reference',
        'user_id',
        'vehicule_id',
        'date_debut',
        'date_fin',
        'heure_debut',
        'heure_fin',
        'prix_journalier',
        'nombre_jours',
        'sous_total',
        'frais_service',
        'taxes',
        'reduction',
        'prix_total',
        'montant_acompte',
        'solde_a_payer',
        'date_limite_paiement',
        'statut',
        'mode_paiement',
        'transaction_id',
        'statut_paiement',
        'avec_chauffeur',
        'frais_chauffeur',
        'options_supplementaires',
        'frais_options',
        'nom_conducteur',
        'prenom_conducteur',
        'email_conducteur',
        'telephone_conducteur',
        'date_naissance_conducteur',
        'numero_permis',
        'date_delivrance_permis',
        'lieu_prise_en_charge',
        'lieu_retour',
        'commentaires_livraison',
        'commentaires',
        'notes_internes',
        'date_confirmation',
        'date_annulation',
        'raison_annulation',
        'date_prise_en_charge',
        'date_retour_effectif',
        'kilometrage_depart',
        'kilometrage_retour',
        'niveau_carburant_depart',
        'niveau_carburant_retour',
        'etat_des_lieux_entree',
        'etat_des_lieux_sortie',
        'frais_supplementaires',
        'motif_frais_supplementaires',
        'ip_address',
        'user_agent',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'heure_debut' => 'datetime',
        'heure_fin' => 'datetime',
        'prix_journalier' => 'decimal:2',
        'sous_total' => 'decimal:2',
        'frais_service' => 'decimal:2',
        'taxes' => 'decimal:2',
        'reduction' => 'decimal:2',
        'prix_total' => 'decimal:2',
        'montant_acompte' => 'decimal:2',
        'solde_a_payer' => 'decimal:2',
        'date_limite_paiement' => 'date',
        'avec_chauffeur' => 'boolean',
        'frais_chauffeur' => 'decimal:2',
        'options_supplementaires' => 'array',
        'frais_options' => 'decimal:2',
        'date_naissance_conducteur' => 'date',
        'date_delivrance_permis' => 'date',
        'date_confirmation' => 'datetime',
        'date_annulation' => 'datetime',
        'date_prise_en_charge' => 'datetime',
        'date_retour_effectif' => 'datetime',
        'frais_supplementaires' => 'decimal:2',
    ];

    /**
     * Les attributs qui doivent être cachés pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'ip_address',
        'user_agent',
        'notes_internes',
    ];

    /**
     * Les attributs à ajouter à la représentation JSON du modèle.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'reference_formatee',
        'periode',
        'statut_libelle',
        'statut_paiement_libelle',
        'montant_restant',
    ];

    /**
     * Les attributs qui doivent être mutés en dates.
     *
     * @var array
     */
    protected $dates = [
        'date_naissance_conducteur',
        'date_delivrance_permis',
        'date_confirmation',
        'date_annulation',
        'date_prise_en_charge',
        'date_retour_effectif',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Boot le modèle.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reservation) {
            if (empty($reservation->reference)) {
                $reservation->reference = static::genererReference();
            }
            
            if (empty($reservation->date_limite_paiement)) {
                $reservation->date_limite_paiement = now()->addDays(2);
            }
            
            $reservation->calculerPrixTotal();
        });

        static::updating(function ($reservation) {
            if ($reservation->isDirty(['date_debut', 'date_fin', 'prix_journalier', 'frais_service', 'taxes', 'reduction', 'frais_chauffeur', 'frais_options'])) {
                $reservation->calculerPrixTotal();
            }
            
            // Mettre à jour le statut en fonction des dates
            $reservation->mettreAJourStatut();
        });
    }

    /**
     * Obtenir l'utilisateur qui a effectué la réservation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtenir le véhicule réservé.
     */
    public function vehicule(): BelongsTo
    {
        return $this->belongsTo(Vehicule::class);
    }

    /**
     * Obtenir les paiements associés à la réservation.
     */
    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class);
    }

    /**
     * Obtenir l'avis associé à la réservation.
     */
    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class);
    }

    /**
     * Scope pour les réservations en attente.
     */
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    /**
     * Scope pour les réservations confirmées.
     */
    public function scopeConfirmees($query)
    {
        return $query->where('statut', 'confirmee');
    }

    /**
     * Scope pour les réservations en cours.
     */
    public function scopeEnCours($query)
    {
        $today = now()->format('Y-m-d');
        return $query->where('statut', 'confirmee')
                    ->where('date_debut', '<=', $today)
                    ->where('date_fin', '>=', $today);
    }

    /**
     * Scope pour les réservations terminées.
     */
    public function scopeTerminees($query)
    {
        return $query->where('statut', 'terminee');
    }

    /**
     * Scope pour les réservations annulées.
     */
    public function scopeAnnulees($query)
    {
        return $query->where('statut', 'annulee');
    }

    /**
     * Scope pour les réservations à venir.
     */
    public function scopeAVenir($query)
    {
        $today = now()->format('Y-m-d');
        return $query->where('statut', 'confirmee')
                    ->where('date_debut', '>', $today);
    }

    /**
     * Scope pour les réservations passées.
     */
    public function scopePassees($query)
    {
        $today = now()->format('Y-m-d');
        return $query->where('date_fin', '<', $today)
                    ->whereIn('statut', ['confirmee', 'terminee']);
    }

    /**
     * Obtenir la référence formatée.
     */
    public function getReferenceFormateeAttribute(): string
    {
        return 'RES-' . strtoupper(substr($this->reference, 0, 8));
    }

    /**
     * Obtenir la période de location formatée.
     */
    public function getPeriodeAttribute(): string
    {
        $dateDebut = $this->date_debut->format('d/m/Y');
        $dateFin = $this->date_fin->format('d/m/Y');
        $heureDebut = $this->heure_debut ? ' à ' . $this->heure_debut->format('H:i') : '';
        $heureFin = $this->heure_fin ? ' à ' . $this->heure_fin->format('H:i') : '';
        
        return "Du $dateDebut$heureDebut au $dateFin$heureFin";
    }

    /**
     * Obtenir le libellé du statut.
     */
    public function getStatutLibelleAttribute(): string
    {
        return self::STATUTS[$this->statut] ?? 'Inconnu';
    }

    /**
     * Obtenir le libellé du statut de paiement.
     */
    public function getStatutPaiementLibelleAttribute(): string
    {
        return self::STATUTS_PAIEMENT[$this->statut_paiement] ?? 'Inconnu';
    }

    /**
     * Obtenir le montant restant à payer.
     */
    public function getMontantRestantAttribute(): float
    {
        $totalPaye = $this->paiements()->where('statut', 'valide')->sum('montant');
        return max(0, $this->prix_total - $totalPaye);
    }

    /**
     * Générer une référence unique pour une réservation.
     */
    public static function genererReference(): string
    {
        do {
            $reference = strtoupper(Str::random(8));
        } while (static::where('reference', $reference)->exists());

        return $reference;
    }

    /**
     * Calculer le prix total de la réservation.
     */
    public function calculerPrixTotal(): void
    {
        $this->nombre_jours = $this->date_debut->diffInDays($this->date_fin) + 1;
        $this->sous_total = $this->prix_journalier * $this->nombre_jours;
        
        // Calculer le total des frais
        $totalFrais = $this->frais_service + $this->taxes + $this->frais_chauffeur + $this->frais_options;
        
        // Appliquer la réduction si elle existe
        $montantReduction = 0;
        if ($this->reduction > 0) {
            $montantReduction = $this->sous_total * ($this->reduction / 100);
        }
        
        $this->prix_total = $this->sous_total + $totalFrais - $montantReduction;
        $this->solde_a_payer = $this->prix_total - $this->montant_acompte;
    }

    /**
     * Confirmer la réservation.
     */
    public function confirmer(string $commentaire = null): bool
    {
        if ($this->statut !== 'en_attente') {
            return false;
        }

        $this->statut = 'confirmee';
        $this->date_confirmation = now();
        
        if ($commentaire) {
            $this->notes_internes = ($this->notes_internes ? $this->notes_internes . "\n" : '') . 
                                 now()->format('d/m/Y H:i') . " - Réservation confirmée : $commentaire";
        }
        
        return $this->save();
    }

    /**
     * Annuler la réservation.
     */
    public function annuler(string $raison, bool $rembourser = false): bool
    {
        if (!in_array($this->statut, ['en_attente', 'confirmee'])) {
            return false;
        }

        $this->statut = 'annulee';
        $this->date_annulation = now();
        $this->raison_annulation = $raison;
        
        if ($rembourser && $this->montant_restant > 0) {
            // Logique de remboursement ici
            $this->statut_paiement = 'rembourse';
        }
        
        $this->notes_internes = ($this->notes_internes ? $this->notes_internes . "\n" : '') . 
                             now()->format('d/m/Y H:i') . " - Réservation annulée : $raison";
        
        return $this->save();
    }

    /**
     * Vérifier si la réservation peut être annulée.
     */
    public function estAnnulable(): bool
    {
        return in_array($this->statut, ['en_attente', 'confirmee']) && 
               $this->date_debut->diffInDays(now(), false) > 1; // Au moins 24h avant le début
    }

    /**
     * Vérifier si la réservation peut être modifiée.
     */
    public function estModifiable(): bool
    {
        return in_array($this->statut, ['en_attente', 'confirmee']) && 
               $this->date_debut->diffInDays(now(), false) > 2; // Au moins 48h avant le début
    }

    /**
     * Mettre à jour le statut de la réservation en fonction des dates.
     */
    public function mettreAJourStatut(): void
    {
        $today = now();
        
        if ($this->statut === 'confirmee') {
            if ($today->between($this->date_debut, $this->date_fin)) {
                $this->statut = 'en_cours';
            } elseif ($today > $this->date_fin) {
                $this->statut = 'terminee';
            }
        } elseif ($this->statut === 'en_cours' && $today > $this->date_fin) {
            $this->statut = 'terminee';
        }
    }

    /**
     * Obtenir le nombre de jours restants avant le début de la location.
     */
    public function joursRestants(): int
    {
        return max(0, $this->date_debut->diffInDays(now(), false) * -1);
    }

    /**
     * Obtenir le pourcentage de paiement effectué.
     */
    public function pourcentagePaiement(): float
    {
        if ($this->prix_total <= 0) {
            return 0;
        }
        
        $totalPaye = $this->paiements()->where('statut', 'valide')->sum('montant');
        return min(100, ($totalPaye / $this->prix_total) * 100);
    }

    /**
     * Vérifier si le paiement est complet.
     */
    public function estPayeeIntegralement(): bool
    {
        return $this->montant_restant <= 0;
    }
}
