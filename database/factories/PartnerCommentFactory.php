<?php

use App\Partner;
use App\PartnerComment;
use App\User;
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

$factory->define(PartnerComment::class, function (Faker $faker) {
    return [
    	'comment_id' => (string) Str::uuid(),
        'to' => User::all()->random()->user_id,
        'made_by' => User::all()->random()->user_id,
        'comment' => $faker->paragraph(2),
    ];
});
