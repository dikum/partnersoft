<?php

use App\Title;
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

$factory->define(Title::class, function (Faker $faker) {
    return [
    	'title_id' => (string) Str::uuid(),
        'title' => $faker->unique()->title,
    ];
});
