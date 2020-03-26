<?php

use App\Country;
use App\Currency;
use App\Partner;
use App\State;
use App\Title;
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
    $gender = $faker->randomElement(['male', 'female']);
    return [
    	'user_id' => (string) Str::uuid(),
    	'partner_id' => $type == User::PARTNER_USER ? Country::all()->random()->country_code . '939748' : null,
    	'title_id' => $type == User::PARTNER_USER ? Title::all()->random()->title_id : null,
    	'state_id' => $type == User::PARTNER_USER ? State::all()->random()->state_id : null,
    	'currency_id' => $type == User::PARTNER_USER ? Currency::all()->random()->currency_id : null,
    	'status' => $faker->randomElement([User::ACTIVE_USER, User::INACTIVE_USER, User::SUSPENDED_USER]),
    	'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email2' => $type == User::PARTNER_USER ? $faker->randomElement([$faker->unique()->safeEmail, '']) : null,
    	'phone' => $faker->numberBetween(1000,50000),
    	'phone2' => $type == User::PARTNER_USER ? $faker->numberBetween(1000,50000) : null,
    	'sex' => $type == User::PARTNER_USER ? $gender : null,
    	'date_of_birth' => $type == User::PARTNER_USER ? $faker->dateTime('now') : null,
    	'marital_status' => $type == User::PARTNER_USER ? $faker->randomElement([User::MARRIED_MARITAL_STATUS, User::DIVORCED_MARITAL_STATUS, User::SINGLE_MARITAL_STATUS]) : null,
    	'occupation' => $type == User::PARTNER_USER ? $faker->jobTitle : null,
    	'donation_type' => $type == User::PARTNER_USER ? $faker->randomElement([User::DONATION, User::EMMANUELTV]) : null,
        'donation_amount' => $type == User::PARTNER_USER ? $faker->randomFloat(2, 5000, 1000000) : null,
    	'birth_country' => $type == User::PARTNER_USER ? Country::all()->random()->country_id : null,
    	'residential_country' => $type == User::PARTNER_USER ? Country::all()->random()->country_id : null,
    	'residential_address' => $type == User::PARTNER_USER ? $faker->address : null,
    	'postal_address' => $type == User::PARTNER_USER ? $faker->postcode . ' '. $faker->state . ' ' .$faker->city . ' ' .$faker->country : null,
    	'preflang' => $type == User::PARTNER_USER ? $faker->randomElement([User::ENGLISH_PREFERRED_LANGUAGE, User::SPANISH_PREFERRED_LANGUAGE, User::FRENCH_PREFERRED_LANGUAGE]) : null,
    	'type' => $type,
        'branch' => $faker->randomElement([User::LAGOS_BRANCH, User::SOUTH_AFRICA_BRANCH, User::GHANA_BRANCH]),
        'registered_by' => null,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => Str::random(10),
    	'verified' => $verified =  $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]),
    	'verification_token' => $verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),
    ];
});
