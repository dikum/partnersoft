<?php

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

$factory->define(User::class, function (Faker $faker) {
	static $password;
	$type = $faker->randomElement([User::ADMIN_USER, User::REGULAR_USER, User::PARTNER_USER]);
    return [
    	'user_id' => (string) Str::uuid(),
    	'partner_id' => $faker->randomElement([Country::all()->random()->country_code . '939748'], null),
    	'title_id' => Title::all()->random()->title_id,
    	'state_id' => State::all()->random()->state_id,
    	'currency_id' => Currency::all()->random()->currency_id,
    	'status' => $faker->randomElement([User::ACTIVE_USER, User::INACTIVE_USER, User::SUSPENDED_USER]),
    	'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email2' => $faker->randomElement([$faker->unique()->safeEmail, '']),
    	'phone' => $faker->numberBetween(1000,50000),
    	'phone2' => $faker->numberBetween(1000,50000),
    	'sex' => $gender,
    	'date_of_birth' => $faker->dateTime('now'),
    	'marital_status' => $faker->randomElement([Partner::MARRIED_MARITAL_STATUS, Partner::DIVORCED_MARITAL_STATUS, Partner::SINGLE_MARITAL_STATUS]),
    	'occupation' => $faker->jobTitle,
    	'donation_type' => $faker->randomElement([Partner::DONATION, Partner::EMMANUELTV]),
        'donation_amount' => $faker->randomFloat(2, 5000, 1000000),
    	'birth_country' => Country::all()->random()->country_id,
    	'residential_country' => Country::all()->random()->country_id,
    	'residential_address' => $faker->address,
    	'postal_address' => $faker->postcode . ' '. $faker->state . ' ' .$faker->city . ' ' .$faker->country,
    	'preflang' => $faker->randomElement([Partner::ENGLISH_PREFERRED_LANGUAGE, Partner::SPANISH_PREFERRED_LANGUAGE, Partner::FRENCH_PREFERRED_LANGUAGE]),
    	'type' => $type,
        'branch' => $faker->randomElement([User::LAGOS_BRANCH, User::SOUTH_AFRICA_BRANCH, User::GHANA_BRANCH]),
        'registered_by' => $faker->randomElement([User::all()->random()->user_id, null]),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    	'verified' => $verified =  $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]),
    	'verification_token' => $verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),
    ];
});
