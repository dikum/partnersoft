<?php

use App\Email;
use App\Partner;
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

$factory->define(Email::class, function (Faker $faker) {
	$partner = Partner::all()->random();
    return [
    	'email_id' => (string) Str::uuid(),
        'partner_id' => $partner->partner_uuid,
        'user_id' => User::all()->random()->user_id,
        'sender' => 'info@emmanuel.tv',
        'recipient' => $faker->safeEmail,
        'subject' => $faker->word,
        'message' => $faker->paragraph(2),
        'status' => $faker->randomElement([Email::MESSAGE_SENT, Email::MESSAGE_RESENT]),
    ];
});
