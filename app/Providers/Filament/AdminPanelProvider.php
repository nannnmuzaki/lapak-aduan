<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Register;
use App\Http\Middleware\RestrictPanelAccess;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use App\Filament\Widgets\LatestPengaduanTable;
use App\Filament\Widgets\PengaduanPerBulanChart;
use App\Filament\Widgets\PengaduanPerChannelChart;
use App\Filament\Widgets\PengaduanPerKategoriChart;
use App\Filament\Widgets\PengaduanStatsOverview;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Auth\Http\Responses\Contracts\LoginResponse as LoginResponseContract;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse as RegistrationResponseContract;
use Filament\Auth\Http\Responses\Contracts\EmailVerificationResponse as EmailVerificationResponseContract;
use Filament\Auth\Http\Responses\Contracts\BlockEmailChangeVerificationResponse as BlockEmailChangeVerificationResponseContract;
use Filament\Auth\Http\Responses\Contracts\PasswordResetResponse as PasswordResetResponseContract;
use Filament\Auth\Http\Responses\Contracts\LogoutResponse as LogoutResponseContract;
use App\Http\Responses\LoginResponse;
use App\Http\Responses\RegistrationResponse;
use App\Http\Responses\EmailVerificationResponse;
use App\Http\Responses\BlockEmailChangeVerificationResponse;
use App\Http\Responses\PasswordResetResponse;
use App\Http\Responses\LogoutResponse;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->spa()
            ->id('admin')
            ->path('main')
            ->login()
            ->registration(Register::class)
            ->emailVerification()
            ->emailChangeVerification()
            ->profile(isSimple: false)
            ->passwordReset()
            ->colors([
                'primary' => Color::Sky,
            ])
            ->brandLogo(view('components.logo'))
            ->brandLogoHeight('2.5rem')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                PengaduanStatsOverview::class,
                PengaduanPerBulanChart::class,
                PengaduanPerChannelChart::class,
                PengaduanPerKategoriChart::class,
                LatestPengaduanTable::class,
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
                RestrictPanelAccess::class,
            ]);
    }

    public function register(): void
    {
        parent::register();

        $this->app->singleton(
            LoginResponseContract::class,
            LoginResponse::class
        );

        $this->app->singleton(
            RegistrationResponseContract::class,
            RegistrationResponse::class
        );

        $this->app->singleton(
            EmailVerificationResponseContract::class,
            EmailVerificationResponse::class
        );

        $this->app->singleton(
            BlockEmailChangeVerificationResponseContract::class,
            BlockEmailChangeVerificationResponse::class
        );

        $this->app->singleton(
            PasswordResetResponseContract::class,
            PasswordResetResponse::class
        );

        $this->app->singleton(
            LogoutResponseContract::class,
            LogoutResponse::class
        );
    }
}
