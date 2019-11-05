<?php

use App\BankStatement;
use App\Partner;
use App\Payment;
use App\User;
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

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'partner_id' => Partner::all()->random()->id,
        'bankstatement_id' => BankStatement::all()->random()->id,
        'entered_by' => $faker->randomElement([User::all()->random()->name, 'system']),
    ];
});
