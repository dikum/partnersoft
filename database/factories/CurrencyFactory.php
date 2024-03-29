<?php

use App\Currency;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Ramsey\Uuid\uuid;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Currency::class, function (Faker $faker) {
    return [
    	'currency_id' => (string) Str::uuid(),
        'currency' => $currency = $faker->unique()->currencyCode,
        'currency_code' => $currency,
        'minimum_amount' => 5000.00,
    ];
});
