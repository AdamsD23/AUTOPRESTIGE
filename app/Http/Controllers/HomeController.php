<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Vehicule;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'vedettes' => Vehicule::with('categorie')->disponibles()->where('est_en_vedette', true)->orderByDesc('nombre_locations')->take(6)->get(),
            'categories' => Categorie::withCount(['vehicules' => fn ($q) => $q->disponibles()])->orderBy('ordre_affichage')->get(),
            'nombreVehicules' => Vehicule::disponibles()->count(),
            'prixMinimum' => Vehicule::disponibles()->min('prix_journalier'),
        ]);
    }
}
