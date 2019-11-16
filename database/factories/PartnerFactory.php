<?php

use App\Country;
use App\Currency;
use App\LastPartnerNumber;
use App\Partner;
use App\State;
use App\Title;
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

$factory->define(Partner::class, function (Faker $faker) {
	static $password;
	$gender = $faker->randomElement(['male', 'female']);
    return [
        'partner_id' => $partner_id = Country::all()->random()->country_code . '939748',
    	'title_id' => Title::all()->random()->id,
    	'state_id' => State::all()->random()->id,
    	'surname' => $faker->firstName($gender),
    	'middle_name' => $faker->randomElement([$faker->firstName($gender), '']),
    	'first_name' => $faker->firstName($gender),
    	'sex' => $gender,
    	'date_of_birth' => $faker->dateTime('now'),
    	'marital_status' => $faker->randomElement([Partner::MARRIED_MARITAL_STATUS, Partner::DIVORCED_MARITAL_STATUS, Partner::SINGLE_MARITAL_STATUS]),
    	'occupation' => $faker->jobTitle,
    	'note' => $faker->paragraph(1),

    	'birth_country' => Country::all()->random()->id,
    	'residential_country' => Country::all()->random()->id,
    	'email' => $faker->unique()->safeEmail,
    	'email2' => $faker->randomElement([$faker->unique()->safeEmail, '']),
    	'phone' => $faker->numberBetween(1000,50000),
    	'phone2' => $faker->numberBetween(1000,50000),
    	'residential_address' => $faker->address,
    	'postal_address' => $faker->postcode . ' '. $faker->state . ' ' .$faker->city . ' ' .$faker->country,

    	'currency_id' => Currency::all()->random()->id,
        'donation_type' => $faker->randomElement([Partner::DONATION, Partner::EMMANUELTV]),
        'donation_amount' => $faker->randomFloat(2, 5000, 1000000),

    	'preflang' => $faker->randomElement([Partner::ENGLISH_PREFERRED_LANGUAGE, Partner::SPANISH_PREFERRED_LANGUAGE, Partner::FRENCH_PREFERRED_LANGUAGE]),
    	'status' => $partner_id == '' ? Partner::PENDING_STATUS : Partner::ACTIVE_STATUS,
    	'password' => $password ?: $password = bcrypt('secret'),
    	//'remember_token' => str_random(10),
    	'verified' => $verified = $faker->randomElement([Partner::VERIFIED_PARTNER, Partner::UNVERIFIED_PARTNER]),
    	'verification_token' => $verified == Partner::VERIFIED_PARTNER ? null : Partner::generateVerificationCode(),
    	
    ];
});
