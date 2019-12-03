<?php

use App\MessageTemplate;
use App\Partner;
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

$factory->define(MessageTemplate::class, function (Faker $faker) {
    return [
    	'message_template_id' => (string) Str::uuid(),
        'title' => 'welcome',
        'message' => $faker->paragraph(2),
    ];
});
