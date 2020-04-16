<?php

namespace App\Providers;

use App\Bank;
use App\BankStatement;
use App\Continent;
use App\Country;
use App\Currency;
use App\Email;
use App\MessageTemplate;
use App\Partner;
use App\Policies\BankPolicy;
use App\Policies\BankStatementPolicy;
use App\Policies\ContinentPolicy;
use App\Policies\CountryPolicy;
use App\Policies\CurrencyPolicy;
use App\Policies\EmailPolicy;
use App\Policies\MessageTemplatePolicy;
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
        Bank::class => BankPolicy::class,
        BankStatement::class => BankStatementPolicy::class,
        Continent::class => ContinentPolicy::class,
        Country::class => CountryPolicy::class,
        Currency::class => CurrencyPolicy::class,
        Email::class => EmailPolicy::class,
        MessageTemplate::class => MessageTemplatePolicy::class,
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
            if($user->isAdmin() || $user->isRegularUser() || $user->user_id == $partner->user_id);
                return true;
            return false;
        });

        Gate::define('view-partners', function ($user) 
        {
            if($user->isAdmin() || $user->isRegularUser())
                return true;
            return false;
        });

        Gate::define('update-partner', function ($user, $partner) 
        {
            if($user->isAdmin() || $user->isRegularUser() || $user->user_id == $partner->user_id)
                return true;
            return false;
        });


        Gate::define('delete-partner', function ($user, $partner) 
        {
            if($user->isAdmin())
                return true;
            return false;
        });


    }
}
