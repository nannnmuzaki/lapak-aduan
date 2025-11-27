<?php

namespace App\Providers;

use App\Models\ChannelPengaduan;
use App\Models\JenisPengaduan;
use App\Models\KategoriPengaduan;
use App\Models\Opd;
use App\Models\Pengaduan;
use App\Models\User;
use App\Policies\ChannelPengaduanPolicy;
use App\Policies\JenisPengaduanPolicy;
use App\Policies\KategoriPengaduanPolicy;
use App\Policies\OpdPolicy;
use App\Policies\PengaduanPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

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
        Gate::policy(Pengaduan::class, PengaduanPolicy::class);
        Gate::policy(JenisPengaduan::class, JenisPengaduanPolicy::class);
        Gate::policy(KategoriPengaduan::class, KategoriPengaduanPolicy::class);
        Gate::policy(ChannelPengaduan::class, ChannelPengaduanPolicy::class);
        Gate::policy(Opd::class, OpdPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Role::class, RolePolicy::class);
    }
}
