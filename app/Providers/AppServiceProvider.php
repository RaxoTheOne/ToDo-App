<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Erzwinge Basis-URL und Scheme aus APP_URL für alle URL-Generierungen
        URL::forceRootUrl(config('app.url'));
        $scheme = parse_url(config('app.url'), PHP_URL_SCHEME) ?: 'http';
        URL::forceScheme($scheme);

        // Email-Verifizierung deaktiviert: keine speziellen VerifyEmail-URLs oder Mails
    }
}
