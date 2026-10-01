<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Reservation;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VehiculeController extends Controller
{
    /**
     * Catalogue avec filtres : catégorie, budget, boîte, carburant, places, recherche, et dates de disponibilité.
     */
    public function index(Request $request): View
    {
        $filtres = $request->validate([
            'categorie' => ['nullable', 'string', 'max:100'],
            'prix_max' => ['nullable', 'integer', 'min:0'],
            'boite' => ['nullable', 'in:' . implode(',', array_keys(Vehicule::BOITES))],
            'carburant' => ['nullable', 'in:' . implode(',', array_keys(Vehicule::CARBURANTS))],
            'places' => ['nullable', 'integer', 'min:1', 'max:9'],
            'q' => ['nullable', 'string', 'max:100'],
            'debut' => ['nullable', 'date', 'after_or_equal:today'],
            'fin' => ['nullable', 'date', 'after_or_equal:debut'],
            'tri' => ['nullable', 'in:prix_asc,prix_desc,populaire'],
        ]);

        $query = Vehicule::with('categorie')->disponibles()
            ->when($filtres['categorie'] ?? null, fn ($q, $slug) => $q->whereHas('categorie', fn ($c) => $c->where('slug', $slug)))
            ->when($filtres['prix_max'] ?? null, fn ($q, $max) => $q->where('prix_journalier', '<=', $max))
            ->when($filtres['boite'] ?? null, fn ($q, $boite) => $q->where('boite', $boite))
            ->when($filtres['carburant'] ?? null, fn ($q, $c) => $q->where('carburant', $c))
            ->when($filtres['places'] ?? null, fn ($q, $p) => $q->where('places', '>=', $p))
            ->when($filtres['q'] ?? null, fn ($q, $texte) => $q->where(fn ($w) => $w
                ->where('marque', 'like', "%{$texte}%")
                ->orWhere('modele', 'like', "%{$texte}%")));

        // Avec des dates : on écarte les véhicules déjà réservés sur la période
        if (! empty($filtres['debut']) && ! empty($filtres['fin'])) {
            $query->whereDoesntHave('reservations', fn ($r) => $r
                ->whereIn('statut', Reservation::STATUTS_ACTIFS)
                ->whereDate('date_debut', '<=', $filtres['fin'])
                ->whereDate('date_fin', '>=', $filtres['debut']));
        }

        match ($filtres['tri'] ?? null) {
            'prix_asc' => $query->orderBy('prix_journalier'),
            'prix_desc' => $query->orderByDesc('prix_journalier'),
            'populaire' => $query->orderByDesc('nombre_locations'),
            default => $query->orderByDesc('est_en_vedette')->orderBy('prix_journalier'),
        };

        return view('vehicules.index', [
            'vehicules' => $query->paginate(9)->withQueryString(),
            'categories' => Categorie::orderBy('ordre_affichage')->get(),
            'filtres' => $filtres,
        ]);
    }

    public function show(Vehicule $vehicule): View
    {
        abort_unless($vehicule->est_disponible || auth()->user()?->isAdmin(), 404);

        // Périodes déjà prises, affichées au client pour l'aider à choisir ses dates
        $periodesPrises = $vehicule->reservations()
            ->whereIn('statut', Reservation::STATUTS_ACTIFS)
            ->whereDate('date_fin', '>=', now()->toDateString())
            ->orderBy('date_debut')
            ->get(['date_debut', 'date_fin']);

        return view('vehicules.show', [
            'vehicule' => $vehicule->load('categorie'),
            'periodesPrises' => $periodesPrises,
            'similaires' => Vehicule::disponibles()->where('id', '!=', $vehicule->id)
                ->orderByRaw('categorie_id = ? DESC', [$vehicule->categorie_id])
                ->orderBy(DB::raw('ABS(prix_journalier - ' . (int) $vehicule->prix_journalier . ')'))
                ->take(3)->get(),
        ]);
    }
}
