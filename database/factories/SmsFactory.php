<?php

use App\Partner;
use App\Sms;
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

$factory->define(Sms::class, function (Faker $faker) {
	$partner = Partner::all()->random();
    return [
        'partner_id' => $partner->id,
        'sender' => '+234808765527',
        'recipient' => $faker->numberBetween(1000,50000),
        'message' => $faker->paragraph(2),
        'status' => $faker->randomElement([Sms::MESSAGE_SENT, Sms::MESSAGE_RESENT]),
    ];
});
