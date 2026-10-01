<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Affiche le formulaire de création de réservation
     */
    public function create()
    {
        // Récupérer la liste des véhicules disponibles
        $vehicules = Vehicule::where('disponible', true)->get();
        
        return view('reservations.create', compact('vehicules'));
    }

    /**
     * Enregistre une nouvelle réservation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicule_id' => 'required|exists:vehicules,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'commentaires' => 'nullable|string',
        ]);

        // Vérifier si le véhicule est disponible pour la période demandée
        $existingReservation = Reservation::where('vehicule_id', $validated['vehicule_id'])
            ->where(function($query) use ($validated) {
                $query->whereBetween('date_debut', [$validated['date_debut'], $validated['date_fin']])
                      ->orWhereBetween('date_fin', [$validated['date_debut'], $validated['date_fin']])
                      ->orWhere(function($q) use ($validated) {
                          $q->where('date_debut', '<=', $validated['date_debut'])
                            ->where('date_fin', '>=', $validated['date_fin']);
                      });
            })
            ->whereIn('statut', ['en_attente', 'confirmee'])
            ->exists();

        if ($existingReservation) {
            return back()->withErrors([
                'date_debut' => 'Le véhicule n\'est pas disponible pour la période sélectionnée.'
            ])->withInput();
        }

        // Calculer le prix total (à implémenter selon votre logique de tarification)
        $vehicule = Vehicule::findOrFail($validated['vehicule_id']);
        $jours = \Carbon\Carbon::parse($validated['date_debut'])
            ->diffInDays(\Carbon\Carbon::parse($validated['date_fin'])) + 1;
        $prixTotal = $vehicule->prix_jour * $jours;

        // Créer la réservation
        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->vehicule_id = $validated['vehicule_id'];
        $reservation->date_debut = $validated['date_debut'];
        $reservation->date_fin = $validated['date_fin'];
        $reservation->prix_total = $prixTotal;
        $reservation->statut = 'en_attente';
        $reservation->nom_client = $validated['nom'];
        $reservation->email_client = $validated['email'];
        $reservation->telephone_client = $validated['telephone'];
        $reservation->commentaires = $validated['commentaires'] ?? null;
        $reservation->save();

        // Rediriger vers la page de confirmation
        return redirect()->route('reservations.confirmation', $reservation)
            ->with('success', 'Votre réservation a été enregistrée avec succès !');
    }

    /**
     * Affiche la page de confirmation de réservation
     */
    public function confirmation(Reservation $reservation)
    {
        // Vérifier que l'utilisateur a le droit de voir cette réservation
        if (Auth::id() !== $reservation->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('reservations.confirmation', compact('reservation'));
    }

    /**
     * Affiche les réservations de l'utilisateur connecté
     */
    public function mesReservations()
    {
        $reservations = Auth::user()->reservations()
            ->with('vehicule')
            ->latest()
            ->paginate(10);

        return view('reservations.index', compact('reservations'));
    }
}
