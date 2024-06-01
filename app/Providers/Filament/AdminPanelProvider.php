<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Firefly\FilamentBlog\Blog;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Blade;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\PenjualanChart;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use GeoSot\FilamentEnvEditor\FilamentEnvEditorPlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentGeneralSettings\FilamentGeneralSettingsPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->spa()
            ->spaUrlExceptions([
                '*/admin/data-scans/*',
            ])
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile()
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                StatsOverview::class,
                PenjualanChart::class,
            ])
            ->plugins([
                // FilamentImageLibraryPlugin::make()
                //     ->allowedDisks([
                //         'public/storage/images' => 'Public images',
                //     ]),
                FilamentGeneralSettingsPlugin::make()
                    ->setIcon('heroicon-o-cog'),
                FilamentEnvEditorPlugin::make(),
                Blog::make(),
                FilamentSpatieLaravelHealthPlugin::make(),
                FilamentShieldPlugin::make(),
                FilamentEditProfilePlugin::make()
                    ->setIcon('heroicon-o-pencil-square')
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->navigationGroups([
                'Kelola Barang',
                'Blog',
                'Settings',
                'System',
            ])
            ->favicon(asset('favicon.ico'))
            ->renderHook(
                'panels::body.end',
                fn (): string => auth()->check() ? Blade::render('@livewire(\'livewire-ui-modal\')') : '',
            );
    }
}
