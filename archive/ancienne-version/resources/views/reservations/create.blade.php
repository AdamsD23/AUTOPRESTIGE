@extends('layouts.app')

@section('title', 'Nouvelle Réservation')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Nouvelle Réservation</h1>
        
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                <h2 class="font-bold">Erreur de validation</h2>
                <ul class="list-disc pl-5 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informations du client -->
                        <div class="space-y-4">
                            <h2 class="text-xl font-semibold">Informations personnelles</h2>
                            
                            <div>
                                <label for="nom" class="block text-sm font-medium text-gray-700">Nom complet</label>
                                <input type="text" name="nom" id="nom" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            
                            <div>
                                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                                <input type="tel" name="telephone" id="telephone" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                        
                        <!-- Détails de la réservation -->
                        <div class="space-y-4">
                            <h2 class="text-xl font-semibold">Détails de la location</h2>
                            
                            <div>
                                <label for="vehicule_id" class="block text-sm font-medium text-gray-700">Véhicule</label>
                                <select name="vehicule_id" id="vehicule_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Sélectionnez un véhicule</option>
                                    @foreach($vehicules as $vehicule)
                                        <option value="{{ $vehicule->id }}">
                                            {{ $vehicule->marque }} {{ $vehicule->modele }} ({{ $vehicule->immatriculation }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="date_debut" class="block text-sm font-medium text-gray-700">Date de début</label>
                                    <input type="date" name="date_debut" id="date_debut" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                                
                                <div>
                                    <label for="date_fin" class="block text-sm font-medium text-gray-700">Date de fin</label>
                                    <input type="date" name="date_fin" id="date_fin" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>
                            
                            <div>
                                <label for="commentaires" class="block text-sm font-medium text-gray-700">Commentaires</label>
                                <textarea name="commentaires" id="commentaires" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('vehicules.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Confirmer la réservation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateDebut = document.getElementById('date_debut');
        const dateFin = document.getElementById('date_fin');
        const dureeLocation = document.getElementById('duree_location');
        const prixTotal = document.getElementById('prix_total');
        const vehiculeSelect = document.getElementById('vehicule_id');
        const vehicules = @json($vehicules->keyBy('id')->toArray());

        // Fonction pour calculer la durée et le prix total
        function calculerDureeEtPrix() {
            if (!dateDebut.value || !dateFin.value || !vehiculeSelect.value) return;

            const debut = new Date(dateDebut.value);
            const fin = new Date(dateFin.value);
            
            // Vérifier que la date de fin est après la date de début
            if (fin < debut) {
                dateFin.setCustomValidity('La date de fin doit être postérieure à la date de début');
                return;
            } else {
                dateFin.setCustomValidity('');
            }

            // Calculer la durée en jours
            const diffTime = Math.abs(fin - debut);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // +1 pour inclure le dernier jour
            
            // Mettre à jour la durée
            if (dureeLocation) {
                dureeLocation.textContent = diffDays + ' jour' + (diffDays > 1 ? 's' : '');
            }

            // Calculer le prix total
            const vehiculeId = vehiculeSelect.value;
            const vehicule = vehicules[vehiculeId];
            
            if (vehicule && prixTotal) {
                const total = diffDays * parseFloat(vehicule.prix_jour);
                prixTotal.textContent = total.toFixed(2) + ' €';
            }
        }

        // Écouter les changements de dates et de véhicule
        dateDebut.addEventListener('change', calculerDureeEtPrix);
        dateFin.addEventListener('change', calculerDureeEtPrix);
        vehiculeSelect.addEventListener('change', calculerDureeEtPrix);

        // Initialiser les dates min/max
        const today = new Date().toISOString().split('T')[0];
        dateDebut.min = today;
        dateDebut.value = today;
        
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        dateFin.min = tomorrow.toISOString().split('T')[0];
        dateFin.value = tomorrow.toISOString().split('T')[0];

        // Calcul initial
        calculerDureeEtPrix();
    });
</script>
@endpush

@endsection
