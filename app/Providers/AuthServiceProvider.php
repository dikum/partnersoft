<?php

namespace App\Providers;

use App\Partner;
use App\Policies\PartnerPolicy;
use App\Policies\UserPolicy;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //Partner::class => PartnerPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::tokensExpireIn(Carbon::now()->addMinutes(30));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

        Passport::tokensCan([

            'read-partner' => 'View partner information', //For third partner application that would want to retrieve partner's information e.g the visitation app.
        ]);

        //Using gates of Partner model, policy won't work in it's case.

        Gate::define('view-partner', function ($user, $partner) 
        {
            if($user->type == 'admin' || $user->type == 'regular' || $user->user_id == $partner->user_id);
                return true;
            return false;
        });

        Gate::define('view-partners', function ($user) 
        {
            if($user->type == 'admin' || $user->type == 'regular')
                return true;
            return false;
        });

         Gate::define('update-partner', function ($user, $partner) 
        {
            if($user->type == 'admin' || $user->type == 'regular' || $user->user_id == $partner->user_id)
                return true;
            return false;
        });



    }
}
