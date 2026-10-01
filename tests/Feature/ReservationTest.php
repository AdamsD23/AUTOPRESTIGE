<?php

namespace Tests\Feature;

use App\Models\Categorie;
use App\Models\ContactMessage;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    private function vehicule(array $attributs = []): Vehicule
    {
        $categorie = Categorie::firstOrCreate(['slug' => 'suv'], ['nom' => 'SUV']);

        return Vehicule::create([
            'categorie_id' => $categorie->id, 'marque' => 'Toyota', 'modele' => 'RAV4 ' . uniqid(), 'annee' => 2023,
            'prix_journalier' => 50000, 'caution' => 250000, 'carburant' => 'hybride', 'boite' => 'automatique',
            'places' => 5, 'image' => 'images/vehicules/toyota-rav4.jpg', 'description_courte' => 'SUV hybride',
            ...$attributs,
        ]);
    }

    private function donnees(array $surcharge = []): array
    {
        return [
            'date_debut' => now()->addDays(2)->toDateString(),
            'date_fin' => now()->addDays(4)->toDateString(),
            'lieu_prise_en_charge' => 'aeroport',
            'avec_chauffeur' => '1',
            'mode_paiement' => 'wave',
            'telephone' => '07 00 00 00 00',
            ...$surcharge,
        ];
    }

    public function test_le_catalogue_affiche_les_vehicules_disponibles_et_filtre_par_dates(): void
    {
        $libre = $this->vehicule(['modele' => 'Libre']);
        $pris = $this->vehicule(['modele' => 'Pris']);
        $cache = $this->vehicule(['modele' => 'Cache', 'est_disponible' => false]);
        Reservation::create([
            ...Reservation::calculer($pris, now()->addDays(5)->toDateString(), now()->addDays(7)->toDateString(), false, 'agence'),
            'user_id' => User::factory()->create()->id, 'vehicule_id' => $pris->id,
            'date_debut' => now()->addDays(5), 'date_fin' => now()->addDays(7),
            'lieu_prise_en_charge' => 'agence', 'mode_paiement' => 'wave', 'telephone' => '0700000000', 'statut' => 'confirmee',
        ]);

        $this->get('/vehicules')->assertOk()->assertSee('Toyota Libre')->assertSee('Toyota Pris')->assertDontSee('Toyota Cache');

        $this->get('/vehicules?debut=' . now()->addDays(6)->toDateString() . '&fin=' . now()->addDays(8)->toDateString())
            ->assertOk()->assertSee('Toyota Libre')->assertDontSee('Toyota Pris');

        $this->get(route('vehicules.show', $cache))->assertNotFound();
    }

    public function test_il_faut_etre_connecte_pour_reserver(): void
    {
        $vehicule = $this->vehicule();

        $this->get(route('reservations.create', $vehicule))->assertRedirect('/login');
        $this->post(route('reservations.store', $vehicule), $this->donnees())->assertRedirect('/login');
        $this->assertDatabaseCount('reservations', 0);
    }

    public function test_une_reservation_calcule_le_prix_cote_serveur(): void
    {
        $vehicule = $this->vehicule();
        $client = User::factory()->create();

        // Le prix envoyé par le navigateur est ignoré : seul le calcul du serveur compte
        $response = $this->actingAs($client)->post(route('reservations.store', $vehicule), $this->donnees(['prix_total' => 1]));

        $reservation = Reservation::firstOrFail();
        $response->assertRedirect(route('reservations.show', $reservation));
        // 3 jours × 50 000 + chauffeur 3 × 25 000 + aéroport 10 000
        $this->assertSame(3, $reservation->nombre_jours);
        $this->assertSame(235000, $reservation->prix_total);
        $this->assertSame('en_attente', $reservation->statut);
        $this->assertStringStartsWith('AP-', $reservation->reference);

        $this->actingAs($client)->get(route('reservations.show', $reservation))->assertOk()->assertSee($reservation->reference);
    }

    public function test_deux_reservations_ne_peuvent_pas_se_chevaucher(): void
    {
        $vehicule = $this->vehicule();
        $this->actingAs(User::factory()->create())->post(route('reservations.store', $vehicule), $this->donnees());

        $autre = User::factory()->create();
        $this->actingAs($autre)
            ->post(route('reservations.store', $vehicule), $this->donnees([
                'date_debut' => now()->addDays(4)->toDateString(),
                'date_fin' => now()->addDays(6)->toDateString(),
            ]))
            ->assertSessionHasErrors('date_debut');

        $this->assertDatabaseCount('reservations', 1);

        // Juste après la première location : accepté
        $this->actingAs($autre)
            ->post(route('reservations.store', $vehicule), $this->donnees([
                'date_debut' => now()->addDays(5)->toDateString(),
                'date_fin' => now()->addDays(6)->toDateString(),
            ]))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseCount('reservations', 2);
    }

    public function test_validation_des_dates_et_de_l_adresse_de_livraison(): void
    {
        $vehicule = $this->vehicule();
        $client = User::factory()->create();

        $this->actingAs($client)->post(route('reservations.store', $vehicule), $this->donnees(['date_debut' => now()->subDay()->toDateString()]))
            ->assertSessionHasErrors('date_debut');
        $this->actingAs($client)->post(route('reservations.store', $vehicule), $this->donnees(['date_fin' => now()->toDateString()]))
            ->assertSessionHasErrors('date_fin');
        $this->actingAs($client)->post(route('reservations.store', $vehicule), $this->donnees(['lieu_prise_en_charge' => 'domicile']))
            ->assertSessionHasErrors('adresse_livraison');
        $this->assertDatabaseCount('reservations', 0);
    }

    public function test_un_client_ne_voit_et_n_annule_que_ses_reservations(): void
    {
        $vehicule = $this->vehicule();
        $proprietaire = User::factory()->create();
        $this->actingAs($proprietaire)->post(route('reservations.store', $vehicule), $this->donnees());
        $reservation = Reservation::firstOrFail();

        $intrus = User::factory()->create();
        $this->actingAs($intrus)->get(route('reservations.show', $reservation))->assertForbidden();
        $this->actingAs($intrus)->patch(route('reservations.annuler', $reservation))->assertForbidden();

        $this->actingAs($proprietaire)->patch(route('reservations.annuler', $reservation))->assertRedirect(route('reservations.index'));
        $this->assertSame('annulee', $reservation->fresh()->statut);

        // Une fois annulée, la période est de nouveau libre
        $this->assertTrue($vehicule->estLibre(now()->addDays(2)->toDateString(), now()->addDays(4)->toDateString()));
    }

    public function test_seul_l_administrateur_accede_a_l_administration(): void
    {
        $vehicule = $this->vehicule();
        $client = User::factory()->create();
        $this->actingAs($client)->post(route('reservations.store', $vehicule), $this->donnees());
        $reservation = Reservation::firstOrFail();

        $this->actingAs($client)->get('/admin')->assertForbidden();
        $this->actingAs($client)->patch(route('admin.reservations.statut', $reservation), ['statut' => 'confirmee'])->assertForbidden();

        $admin = User::factory()->admin()->create();
        $this->actingAs($admin)->get('/admin')->assertOk()->assertSee($reservation->reference);
        $this->actingAs($admin)->patch(route('admin.reservations.statut', $reservation), ['statut' => 'confirmee']);
        $this->assertSame('confirmee', $reservation->fresh()->statut);
        $this->assertNotNull($reservation->fresh()->date_confirmation);

        $this->actingAs($admin)->patch(route('admin.vehicules.disponibilite', $vehicule));
        $this->assertFalse($vehicule->fresh()->est_disponible);
    }

    public function test_le_formulaire_de_contact_enregistre_le_message(): void
    {
        $this->post('/contact', ['nom' => 'Awa', 'email' => 'pas-un-email', 'sujet' => 'Test', 'message' => 'court'])
            ->assertSessionHasErrors(['email', 'message']);

        $this->post('/contact', ['nom' => 'Awa Koné', 'email' => 'awa@example.ci', 'sujet' => 'Mariage', 'message' => 'Bonjour, je voudrais deux voitures.'])
            ->assertRedirect(route('contact'));
        $this->assertSame(1, ContactMessage::count());
    }

    public function test_la_page_d_accueil_s_affiche(): void
    {
        $this->vehicule(['est_en_vedette' => true, 'modele' => 'Vedette']);
        $this->get('/')->assertOk()->assertSee('Toyota Vedette')->assertSee('AutoPrestige');
    }
}
