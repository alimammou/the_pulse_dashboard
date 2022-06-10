<?php

namespace App\Providers;

use Gate;
use Illuminate\Support\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class AuthServiceProvider.
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        if (! $this->app->routesAreCached()) {
            Passport::routes();
        }

        Passport::tokensExpireIn(Carbon::now()->addMinutes(config('auth.token_expires_in_minutes')));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(config('auth.refresh_token_expires_in_days')));

        $this->registerAdminRole();
        $this->registerPermissions();
    }

    public function registerAdminRole(): void
    {
        // Implicitly grant "Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user) {
            return $user->hasRole(config('access.users.admin_role')) ? true : null;
        });
    }

    public function registerPermissions(): void
    {
        Gate::before(function (Authorizable $user, string $ability) {
            if (method_exists($user, 'hasPermission')) {
                return $user->hasPermission($ability) ?: null;
            }
        });
    }
}
