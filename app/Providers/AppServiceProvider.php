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

        VerifyEmail::createUrlUsing(function ($notifiable) {
            $temporarySigned = URL::temporarySignedRoute(
                'verification.verify.guest',
                now()->addMinutes(60),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );

            return $temporarySigned;
        });

        VerifyEmail::toMailUsing(function ($notifiable, string $url) {
            $guestUrl = URL::temporarySignedRoute(
                'verification.verify.guest',
                now()->addMinutes(60),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );

            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Please click the button below to verify your email address.')
                ->action('Verify Email Address', $guestUrl)
                ->line('If you did not create an account, no further action is required.');
        });
    }
}
