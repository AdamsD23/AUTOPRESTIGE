<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Vehicule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ReservationController extends Controller
{
    /**
     * Mes réservations (tableau de bord du client)
     */
    public function index(Request $request): View
    {
        $reservations = $request->user()->reservations()->with('vehicule')->latest()->get();
        $enCours = fn ($r) => in_array($r->statut, Reservation::STATUTS_ACTIFS, true) && $r->date_fin->copy()->endOfDay()->isFuture();

        return view('reservations.index', [
            'aVenir' => $reservations->filter($enCours),
            'historique' => $reservations->reject($enCours),
        ]);
    }

    public function create(Request $request, Vehicule $vehicule): View
    {
        abort_unless($vehicule->est_disponible, 404);

        return view('reservations.create', [
            'vehicule' => $vehicule,
            'debut' => $request->query('debut', now()->addDay()->toDateString()),
            'fin' => $request->query('fin', now()->addDays(3)->toDateString()),
        ]);
    }

    public function store(Request $request, Vehicule $vehicule): RedirectResponse
    {
        abort_unless($vehicule->est_disponible, 404);

        $data = $request->validate([
            'date_debut' => ['required', 'date', 'after_or_equal:today'],
            'date_fin' => ['required', 'date', 'after_or_equal:date_debut', 'before_or_equal:' . now()->addYear()->toDateString()],
            'lieu_prise_en_charge' => ['required', Rule::in(array_keys(Reservation::LIEUX))],
            'adresse_livraison' => ['nullable', 'required_if:lieu_prise_en_charge,domicile', 'string', 'max:255'],
            'avec_chauffeur' => ['nullable', 'boolean'],
            'mode_paiement' => ['required', Rule::in(array_keys(Reservation::PAIEMENTS))],
            'telephone' => ['required', 'string', 'max:20', 'regex:/^[0-9 +().-]{8,20}$/'],
            'commentaires' => ['nullable', 'string', 'max:1000'],
        ], [
            'adresse_livraison.required_if' => 'Indiquez l\'adresse de livraison.',
            'telephone.regex' => 'Le numéro de téléphone n\'est pas valide.',
        ]);

        $chauffeur = $request->boolean('avec_chauffeur');

        // Transaction + verrou : deux clients ne peuvent pas réserver la même période en même temps
        $reservation = DB::transaction(function () use ($vehicule, $data, $chauffeur, $request) {
            Vehicule::whereKey($vehicule->id)->lockForUpdate()->first();

            if (! $vehicule->estLibre($data['date_debut'], $data['date_fin'])) {
                throw ValidationException::withMessages([
                    'date_debut' => 'Ce véhicule est déjà réservé sur une partie de cette période. Choisissez d\'autres dates.',
                ]);
            }

            return Reservation::create([
                ...Reservation::calculer($vehicule, $data['date_debut'], $data['date_fin'], $chauffeur, $data['lieu_prise_en_charge']),
                'user_id' => $request->user()->id,
                'vehicule_id' => $vehicule->id,
                'date_debut' => $data['date_debut'],
                'date_fin' => $data['date_fin'],
                'lieu_prise_en_charge' => $data['lieu_prise_en_charge'],
                'adresse_livraison' => $data['lieu_prise_en_charge'] === 'domicile' ? $data['adresse_livraison'] : null,
                'avec_chauffeur' => $chauffeur,
                'mode_paiement' => $data['mode_paiement'],
                'telephone' => $data['telephone'],
                'commentaires' => $data['commentaires'] ?? null,
            ]);
        });

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Votre demande de réservation est enregistrée !');
    }

    public function show(Request $request, Reservation $reservation): View
    {
        abort_unless($reservation->user_id === $request->user()->id || $request->user()->isAdmin(), 403);

        return view('reservations.show', ['reservation' => $reservation->load('vehicule', 'user')]);
    }

    public function annuler(Request $request, Reservation $reservation): RedirectResponse
    {
        abort_unless($reservation->user_id === $request->user()->id, 403);

        if (! $reservation->estAnnulable()) {
            return back()->with('error', 'Cette réservation ne peut plus être annulée.');
        }

        $reservation->update(['statut' => 'annulee', 'date_annulation' => now()]);

        return redirect()->route('reservations.index')->with('success', 'Réservation annulée.');
    }
}
