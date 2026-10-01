<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    protected $table = 'categories';

    protected $fillable = ['nom', 'slug', 'description', 'icone', 'ordre_affichage'];

    public function vehicules(): HasMany
    {
        return $this->hasMany(Vehicule::class);
    }
}
