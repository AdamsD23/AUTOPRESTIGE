<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Espace administrateur (protégé par le middleware "admin")
 */
class AdminController extends Controller
{
    public function index(Request $request): View
    {
        $statut = $request->query('statut');

        return view('admin.index', [
            'stats' => [
                'en_attente' => Reservation::where('statut', 'en_attente')->count(),
                'confirmees' => Reservation::where('statut', 'confirmee')->count(),
                'chiffre_affaires' => Reservation::whereIn('statut', ['confirmee', 'terminee'])->sum('prix_total'),
                'clients' => User::where('role', 'client')->count(),
                'messages' => ContactMessage::where('est_lu', false)->count(),
            ],
            'reservations' => Reservation::with('vehicule', 'user')
                ->when(array_key_exists($statut, Reservation::STATUTS), fn ($q) => $q->where('statut', $statut))
                ->orderByRaw("statut = 'en_attente' DESC")->latest()->limit(100)->get(),
            'statut' => $statut,
            'vehicules' => Vehicule::with('categorie')->orderBy('marque')->get(),
            'messages' => ContactMessage::latest()->limit(30)->get(),
        ]);
    }

    public function statutReservation(Request $request, Reservation $reservation): RedirectResponse
    {
        $data = $request->validate(['statut' => ['required', Rule::in(['confirmee', 'refusee', 'terminee', 'annulee'])]]);

        // On ne confirme pas une réservation si le véhicule a été pris entre-temps
        if ($data['statut'] === 'confirmee'
            && ! $reservation->vehicule->estLibre($reservation->date_debut->toDateString(), $reservation->date_fin->toDateString(), $reservation->id)) {
            return back()->with('error', 'Impossible : une autre réservation occupe déjà ce véhicule sur cette période.');
        }

        $reservation->update([
            'statut' => $data['statut'],
            'date_confirmation' => $data['statut'] === 'confirmee' ? now() : $reservation->date_confirmation,
            'date_annulation' => in_array($data['statut'], ['refusee', 'annulee'], true) ? now() : $reservation->date_annulation,
        ]);
        if ($data['statut'] === 'terminee') {
            $reservation->vehicule->increment('nombre_locations');
        }

        return back()->with('success', "Réservation {$reservation->reference} : " . mb_strtolower(Reservation::STATUTS[$data['statut']]) . '.');
    }

    public function disponibilite(Vehicule $vehicule): RedirectResponse
    {
        $vehicule->update(['est_disponible' => ! $vehicule->est_disponible]);

        return back()->with('success', "{$vehicule->nom} est maintenant " . ($vehicule->est_disponible ? 'visible dans le catalogue.' : 'retiré du catalogue.'));
    }

    public function messageLu(ContactMessage $message): RedirectResponse
    {
        $message->update(['est_lu' => true]);

        return back();
    }
}
