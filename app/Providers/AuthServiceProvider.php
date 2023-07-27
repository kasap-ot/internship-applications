<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Student;
use App\Models\Company;
use App\Models\Offer;

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
        Gate::define('is-student', function (User $user) {
            return $user->userable_type == Student::class;
        });

        Gate::define('is-company', function (User $user) {
            return $user->userable_type == Company::class;
        });

        // Checks if the user is the rightful owner of the offer
        Gate::define('offer-owner', function (User $user, Offer $offer) {
            return $user->userable_id == $offer->company_id;
        });
    }
}
