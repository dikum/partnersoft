<?php

use App\Continent;
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

$factory->define(Continent::class, function (Faker $faker) {
    return [
    	'continent_id' => (string) Str::uuid(),
        'continent' => $continent = $faker->word,
        'continent_code' => substr($continent, 0, 3),
    ];
});
