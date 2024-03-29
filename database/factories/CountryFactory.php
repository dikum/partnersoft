<?php

use App\Continent;
use App\Country;
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

$factory->define(Country::class, function (Faker $faker) {
    return [
    	'country_id' => (string) Str::uuid(),
        'continent_id' => Continent::all()->unique()->random()->continent_id,
        'country' => $country = $faker->country,
        'dial_code' => substr($faker->e164PhoneNumber, 0, 3),
        'country_code' => substr($country, 0, 3),
    ];
});
