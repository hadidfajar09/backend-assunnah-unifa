<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use phpDocumentor\Reflection\PseudoTypes\True_;

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
        Gate::define('manage-users', function ($user) {
            if ($user->level == "admin") {
                return TRUE;
            }
        });


        Gate::define('manage-students', function ($user) {
            if ($user->level == "admin") {
                return TRUE;
            }
        });

        Gate::define('manage-categories', function ($user) {
            if ($user->level == "admin") {
                return TRUE;
            }
        });

        Gate::define('manage-courses', function ($user) {
            if ($user->level == "admin") {
                return TRUE;
            }
        });

        Gate::define('manage-modules', function ($user) {
            if ($user->level == "pengajar") {
                return TRUE;
            }
        });

        //
    }
}
