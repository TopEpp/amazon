<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {

        $this->registerPolicies($gate);

        $gate->define('isAdmin', function ($user) {
            return $user->type == 1;
        });

        $gate->define('isManager', function ($user) {
            return $user->type == 2;
        });

        $gate->define('isSale', function ($user) {
            return $user->type == 3;
        });

    }
}
