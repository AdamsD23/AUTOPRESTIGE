#!/bin/sh
set -e
cd /var/www/html

# L'hébergeur (Render…) indique le port à écouter dans $PORT
PORT="${PORT:-80}"
sed -i "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/:80>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Configuration : .env de base + clé de chiffrement générée au démarrage
[ -f .env ] || cp .env.example .env
if [ -z "$APP_KEY" ]; then php artisan key:generate --force; fi

# Démo : base SQLite recréée avec les données d'exemple à chaque démarrage
touch database/database.sqlite
php artisan migrate:fresh --seed --force

php artisan config:cache
php artisan route:cache
php artisan view:cache
chown -R www-data:www-data storage bootstrap/cache database

exec apache2-foreground
