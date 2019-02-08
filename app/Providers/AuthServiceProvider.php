<?php

namespace App\Providers;

use App\Assessment;
use App\Policies\AssessmentPolicy;

use App\Policies\UserPolicy;
use App\User;

use App\Policies\OrganisationPolicy;
use App\Organisation;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Assessment::class => AssessmentPolicy::class,
        User::class => UserPolicy::class,
        Organisation::class => OrganisationPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        //
    }

}
