<?php

namespace App\Providers\Filament;

use App\Filament\Pages\MyProfile;
use App\Livewire\JumlahPesertaChart;
use App\Livewire\RataRataKehadiranChart;
use App\Livewire\StatsOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class InstrukturPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('instruktur')
            ->path('instruktur')
            ->globalSearch(false)
            ->favicon(asset('images/disnaker.png'))
            ->brandName('Halaman Awal')
            ->homeUrl('/')
            ->profile()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Instruktur/Resources'), for: 'App\Filament\Instruktur\Resources')
            ->discoverPages(in: app_path('Filament/Instruktur/Pages'), for: 'App\Filament\Instruktur\Pages')
            ->pages([
                Dashboard::class,
                MyProfile::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Instruktur/Widgets'), for: 'App\Filament\Instruktur\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
                StatsOverview::class,
                JumlahPesertaChart::class,
                RataRataKehadiranChart::class,
            ])
            ->spa()
            ->sidebarWidth('17rem')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->authGuard('web');
    }
}
