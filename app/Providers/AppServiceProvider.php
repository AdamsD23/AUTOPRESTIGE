<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // @fcfa($montant) affiche « 55 000 FCFA »
        Blade::directive('fcfa', fn ($expression) => "<?php echo number_format((float) ($expression), 0, ',', ' ') . ' FCFA'; ?>");

        // En ligne, les liens sont toujours générés en HTTPS
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
