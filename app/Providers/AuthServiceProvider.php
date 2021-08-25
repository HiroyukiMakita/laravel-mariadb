<?php

namespace App\Providers;

use App\Enums\Roles;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Custom Auth
        Auth::provider('custom_auth', function ($app, array $config) {
            return new CustomAuthServiceProvider($this->app['hash'], $config['model']);
        });

        /**
         * Gate
         * 権限の enum に列挙している各権限のゲートを定義する
         */
        foreach (Roles::getLowerKeys() as $label) {
            Gate::define($label, function ($user) use ($label) {
                return ($user->role === Roles::getValue(strtoupper($label)));
            });
        }
    }
}
