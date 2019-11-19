<?php

namespace App\Providers;

use App\Mail\PartnerCreated;
use App\Mail\PartnerMailChanged;
use App\Partner;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Partner::created(function ($partner){
            retry(5, function() use ($partner){
                Mail::to($partner->email)->send(new PartnerCreated($partner));
            }, 1000);
        });

        Partner::updated(function ($partner){
            retry(5, function() use ($partner){

                if($partner->isDirty('email'))
                Mail::to($partner->email)->send(new PartnerMailChanged($partner));

            }, 1000);
            
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
