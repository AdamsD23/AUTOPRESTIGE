<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    use SoftDeletes;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'slug',
        'description',
        'image',
        'icone',
        'est_actif',
        'ordre_affichage',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'est_actif' => 'boolean',
    ];

    /**
     * Obtenir les véhicules de cette catégorie.
     */
    public function vehicules(): HasMany
    {
        return $this->hasMany(Vehicule::class);
    }
}
