# AutoPrestige — location de véhicules à Abidjan

Application web de location de voitures : catalogue filtrable, réservation en ligne avec calcul du prix en direct, espace client et tableau de bord d'administration.

Projet réalisé avec **Laravel 12**, Blade, Alpine.js et Tailwind CSS.

## Fonctionnalités

**Côté client**
- Catalogue des véhicules avec filtres : catégorie, carburant, boîte, places, prix, et disponibilité sur des dates précises.
- Fiche véhicule : caractéristiques, équipements, périodes déjà réservées, véhicules similaires.
- Réservation en ligne : dates, lieu de prise en charge (agence, aéroport, livraison à domicile), option chauffeur, mode de paiement (Wave, Orange Money, espèces). Le total est calculé en direct.
- Contrôle des chevauchements : un véhicule ne peut pas être réservé deux fois sur la même période. La vérification se fait dans une transaction avec verrouillage.
- Espace « Mes réservations » : suivi du statut et annulation tant que la location n'a pas commencé.
- Formulaire de contact.

**Côté administration** (rôle `admin`)
- Statistiques : réservations en attente et confirmées, chiffre d'affaires, nombre de clients, messages non lus.
- Gestion des réservations, filtrables par statut : confirmer, refuser, terminer, annuler.
- Mise en service ou hors service des véhicules.
- Lecture des messages de contact.

## Lancer le projet en local

Prérequis : PHP 8.2+, Composer, Node.js.

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm run build
php artisan serve
```

Puis ouvrir http://127.0.0.1:8000.

### Comptes de démonstration

| Rôle | E-mail | Mot de passe |
|------|--------|--------------|
| Administrateur | admin@autoprestige.ci | valeur de `ADMIN_PASSWORD` (par défaut `admin12345` en local) |
| Client | client@demo.ci | demo12345 |

## Tests

```bash
php artisan test
```

Les tests couvrent l'authentification et le profil, le filtre du catalogue par dates, le calcul du prix côté serveur, le refus des réservations qui se chevauchent, la validation du formulaire, l'annulation (un client ne touche qu'à ses propres réservations), l'accès réservé à l'administration et le formulaire de contact.

## Déploiement (Render)

Le dépôt contient un `Dockerfile` (PHP 8.2 + Apache) et un `render.yaml`.

1. Sur Render : **New + → Blueprint**, puis choisir ce dépôt.
2. Renseigner `ADMIN_PASSWORD`.

La démo utilise SQLite. La base est recréée avec les données d'exemple à chaque redémarrage du service.

## Crédits

Photos des véhicules : [Unsplash](https://unsplash.com).
