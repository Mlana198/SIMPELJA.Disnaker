<?php

namespace App\Providers;

use Filament\Auth\Http\Responses\LogoutResponse;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

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
        app()->singleton(LogoutResponse::class, function () {
            return new class extends LogoutResponse {
                public function toResponse($request): RedirectResponse
                {
                    return redirect('/'); // Arahkan kembali ke halaman 'Started'
                }
            };
        });

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verifikasi Email - SIM-PELJA')
                ->view('emails.verify-email', [
                    'user' => $notifiable,
                    'url' => $url,
                ]);
        });
    }
}
