<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;

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
        // Definir un gate para verificar si el usuario es Admin
        Gate::define('isAdmin', function ($user) {
            return $user->rol === 1; // 1 = Admin
        });

        // Definir un gate para verificar si el usuario es Subadmin
        Gate::define('isSubadmin', function ($user) {
            return $user->rol === 2; // 2 = Subadmin
        });

        // Definir un gate para verificar si el usuario pertenece a la misma empresa
        Gate::define('belongsToCompany', function ($user, $companyId) {
            return $user->id_empresa === $companyId;
        });
    }
}
