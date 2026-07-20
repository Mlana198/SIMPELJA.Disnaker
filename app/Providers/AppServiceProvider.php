<?php

namespace App\Providers;

use Filament\Auth\Http\Responses\LogoutResponse;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\RedirectResponse;

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
    }
}
