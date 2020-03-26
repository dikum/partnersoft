<?php

use App\BankStatement;
use App\Partner;
use App\Payment;
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

$factory->define(Payment::class, function (Faker $faker) {
    return [
    	'payment_id' => (string) Str::uuid(),
        'made_by' => User::all()->random()->user_id,
        'bank_statement_id' => BankStatement::all()->random()->bank_statement_id,
        'entered_by' => $faker->randomElement([User::all()->random()->user_id, null]),
    ];
});
