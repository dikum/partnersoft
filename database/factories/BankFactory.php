<?php

use App\Bank;
use Faker\Generator as Faker;

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

$factory->define(Bank::class, function (Faker $faker) {
    return [
        'bank' => $bank = $faker->unique()->randomElement(['ZENITH','UBA']),
        'bank_code' => $bank == 'ZENITH' ? 'ZEN' : 'UBA',
    ];
});
