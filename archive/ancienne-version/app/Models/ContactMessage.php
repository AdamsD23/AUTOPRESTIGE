<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class ContactMessage extends Model
{
    use SoftDeletes;

    /**
     * Les types de contact possibles.
     *
     * @var array
     */
    const TYPES = [
        'demande_info' => 'Demande d\'information',
        'devis' => 'Demande de devis',
        'reservation' => 'Réservation',
        'reclamation' => 'Réclamation',
        'partenaire' => 'Devenir partenaire',
        'autre' => 'Autre demande',
    ];

    /**
     * Les statuts possibles d'un message.
     *
     * @var array
     */
    const STATUTS = [
        'non_lu' => 'Non lu',
        'en_cours' => 'En cours de traitement',
        'traite' => 'Traité',
        'archive' => 'Archivé',
    ];

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'email',
        'telephone',
        'sujet',
        'message',
        'type',
        'statut',
        'date_lecture',
        'date_reponse',
        'reponse',
        'ip_address',
        'user_agent',
        'fichier_joint',
        'notes',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_lecture' => 'datetime',
        'date_reponse' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Les attributs qui doivent être cachés pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'ip_address',
        'user_agent',
        'deleted_at',
    ];

    /**
     * Les attributs à ajouter à la représentation JSON du modèle.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'nom_complet',
        'type_libelle',
        'statut_libelle',
        'est_lu',
        'est_traite',
    ];

    /**
     * Les attributs qui doivent être mutés en dates.
     *
     * @var array
     */
    protected $dates = [
        'date_lecture',
        'date_reponse',
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

        static::creating(function ($message) {
            if (empty($message->statut)) {
                $message->statut = 'non_lu';
            }
            
            if (empty($message->ip_address) && request()->ip()) {
                $message->ip_address = request()->ip();
            }
            
            if (empty($message->user_agent) && request()->header('User-Agent')) {
                $message->user_agent = substr(request()->header('User-Agent'), 0, 500);
            }
        });
    }

    /**
     * Obtenir l'utilisateur associé au message (si connecté).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope pour les messages non lus.
     */
    public function scopeNonLus($query)
    {
        return $query->where('statut', 'non_lu');
    }

    /**
     * Scope pour les messages en cours de traitement.
     */
    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en_cours');
    }

    /**
     * Scope pour les messages traités.
     */
    public function scopeTraites($query)
    {
        return $query->where('statut', 'traite');
    }

    /**
     * Scope pour les messages archivés.
     */
    public function scopeArchives($query)
    {
        return $query->where('statut', 'archive');
    }

    /**
     * Scope pour les messages d'un type spécifique.
     */
    public function scopeDeType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Obtenir le nom complet de l'expéditeur.
     */
    public function getNomCompletAttribute(): string
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    /**
     * Obtenir le libellé du type de contact.
     */
    public function getTypeLibelleAttribute(): string
    {
        return self::TYPES[$this->type] ?? 'Non spécifié';
    }

    /**
     * Obtenir le libellé du statut.
     */
    public function getStatutLibelleAttribute(): string
    {
        return self::STATUTS[$this->statut] ?? 'Inconnu';
    }

    /**
     * Vérifier si le message a été lu.
     */
    public function getEstLuAttribute(): bool
    {
        return $this->statut !== 'non_lu';
    }

    /**
     * Vérifier si le message a été traité.
     */
    public function getEstTraiteAttribute(): bool
    {
        return $this->statut === 'traite' || $this->statut === 'archive';
    }

    /**
     * Marquer le message comme lu.
     */
    public function marquerCommeLu(): bool
    {
        if ($this->statut === 'non_lu') {
            $this->statut = 'en_cours';
            $this->date_lecture = now();
            return $this->save();
        }
        
        return false;
    }

    /**
     * Marquer le message comme traité.
     */
    public function marquerCommeTraite(string $reponse = null, bool $notifier = false): bool
    {
        $this->statut = 'traite';
        $this->date_reponse = now();
        
        if ($reponse) {
            $this->reponse = $reponse;
        }
        
        $saved = $this->save();
        
        if ($saved && $notifier && $this->email) {
            // Envoyer une notification par email à l'expéditeur
            // Mail::to($this->email)->send(new ContactResponse($this));
        }
        
        return $saved;
    }

    /**
     * Archiver le message.
     */
    public function archiver(): bool
    {
        $this->statut = 'archive';
        return $this->save();
    }

    /**
     * Restaurer un message archivé.
     */
    public function restaurer(): bool
    {
        if ($this->statut === 'archive') {
            $this->statut = 'traite';
            return $this->save();
        }
        
        return false;
    }

    /**
     * Obtenir le temps écoulé depuis la création du message.
     */
    public function tempsEcoule(): string
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Obtenir le temps de réponse (si le message a été traité).
     */
    public function tempsReponse(): ?string
    {
        if ($this->date_reponse) {
            return $this->created_at->diffForHumans($this->date_reponse, true);
        }
        
        return null;
    }

    /**
     * Vérifier si le message a un fichier joint.
     */
    public function aFichierJoint(): bool
    {
        return !empty($this->fichier_joint) && file_exists(storage_path('app/public/contact/' . $this->fichier_joint));
    }

    /**
     * Obtenir l'URL du fichier joint.
     */
    public function urlFichierJoint(): ?string
    {
        if ($this->aFichierJoint()) {
            return asset('storage/contact/' . $this->fichier_joint);
        }
        
        return null;
    }

    /**
     * Obtenir le chemin du fichier joint.
     */
    public function cheminFichierJoint(): ?string
    {
        if ($this->aFichierJoint()) {
            return storage_path('app/public/contact/' . $this->fichier_joint);
        }
        
        return null;
    }

    /**
     * Supprimer le fichier joint.
     */
    public function supprimerFichierJoint(): bool
    {
        if ($this->aFichierJoint()) {
            $chemin = $this->cheminFichierJoint();
            $this->fichier_joint = null;
            $this->save();
            
            return unlink($chemin);
        }
        
        return false;
    }

    /**
     * Obtenir les types de contact disponibles.
     */
    public static function getTypes(): array
    {
        return self::TYPES;
    }

    /**
     * Obtenir les statuts disponibles.
     */
    public static function getStatuts(): array
    {
        return self::STATUTS;
    }
}
