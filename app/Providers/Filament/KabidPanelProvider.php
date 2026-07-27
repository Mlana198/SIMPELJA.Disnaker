<?php

namespace App\Providers\Filament;

use App\Filament\Pages\MyProfile;
use App\Filament\Widgets\KehadiranDanKelulusanChart;
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

class KabidPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('kabid')
            ->path('kabid')
            ->favicon(asset('images/disnaker.png'))
            ->brandName('Halaman Awal')
            ->homeUrl('/')
            ->profile()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Kabid/Resources'), for: 'App\Filament\Kabid\Resources')
            ->discoverPages(in: app_path('Filament/Kabid/Pages'), for: 'App\Filament\Kabid\Pages')
            ->pages([
                Dashboard::class,
                MyProfile::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Kabid/Widgets'), for: 'App\Filament\Kabid\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
                KehadiranDanKelulusanChart::class,
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
