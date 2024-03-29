<?php

use App\LastPartnerNumber;
use Faker\Generator as Faker;
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

$factory->define(LastPartnerNumber::class, function (Faker $faker) {
    return [
    	'last_partner_number_id' => (string) Str::uuid(),
        'last_number' => $faker->numberBetween(500,100),
    ];
});
