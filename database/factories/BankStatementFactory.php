<?php

use App\Bank;
use App\BankStatement;
use App\Currency;
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

$factory->define(BankStatement::class, function (Faker $faker) {
	$partner = Partner::all()->random();
    return [
        'bank_statement_id' => (string) Str::uuid(),
    	'transaction_id' => $faker->md5,
        'bank_id' => Bank::all()->random()->bank_id,
        'currency_id' => Currency::all()->random()->currency_id,
        'partner_id' => $partner->partner_id,
        'depositor' => $faker->name,
        'description' => $faker->paragraph(1),
        'amount' => $faker->randomFloat(2, 5000, 1000000),
    	'payment_date' => $faker->dateTime('now'),
        'value_date' => $faker->dateTime('now'),
        'payment_channel' =>$faker->randomElement(['paydirect', 'quickteller','others']),
        'email' => $partner->email,
        'phone' => $partner->phone,
    
    ];
});
