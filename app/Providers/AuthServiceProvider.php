<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('root', function ($user) {
            return $user->role === 'root';
        });

        Gate::define('administrator', function ($user) {
            return $user->role === 'administrador' || $user->role === 'root';
        });

        Gate::define('collaborator', function ($user) {
            return $user->role === 'colaborador' || $user->role === 'administrador' || $user->role === 'root';
        });
    }
}
