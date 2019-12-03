<?php

use App\State;
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

$factory->define(State::class, function (Faker $faker) {
    return [
    	'state_id' => (string) Str::uuid(),
        'state' => $faker->unique()->state,
    ];
});
