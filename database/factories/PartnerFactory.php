<?php

use App\Country;
use App\Currency;
use App\LastPartnerNumber;
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

$factory->define(Partner::class, function (Faker $faker) {
	static $password;

    $partner_id;

	$gender = $faker->randomElement(['male', 'female']);

    return [
        'partner_uuid' => (string) Str::uuid(),
        'partner_id' => $faker->randomElement([$partner_id = Country::all()->random()->country_code . '939748'], null),
        'user_id' => User::all()->random()->user_id,
        'registered_by' => $faker->randomElement([User::all()->random()->user_id, null]),
    	'title_id' => Title::all()->random()->title_id,
    	'state_id' => State::all()->random()->state_id,
    	'sex' => $gender,
    	'date_of_birth' => $faker->dateTime('now'),
    	'marital_status' => $faker->randomElement([Partner::MARRIED_MARITAL_STATUS, Partner::DIVORCED_MARITAL_STATUS, Partner::SINGLE_MARITAL_STATUS]),
    	'occupation' => $faker->jobTitle,
    	'birth_country' => Country::all()->random()->country_id,
    	'residential_country' => Country::all()->random()->country_id,
    	'email2' => $faker->randomElement([$faker->unique()->safeEmail, '']),
    	'phone' => $faker->numberBetween(1000,50000),
    	'phone2' => $faker->numberBetween(1000,50000),
    	'residential_address' => $faker->address,
    	'postal_address' => $faker->postcode . ' '. $faker->state . ' ' .$faker->city . ' ' .$faker->country,
    	'currency_id' => Currency::all()->random()->currency_id,
        'donation_type' => $faker->randomElement([Partner::DONATION, Partner::EMMANUELTV]),
        'donation_amount' => $faker->randomFloat(2, 5000, 1000000),
    	'preflang' => $faker->randomElement([Partner::ENGLISH_PREFERRED_LANGUAGE, Partner::SPANISH_PREFERRED_LANGUAGE, Partner::FRENCH_PREFERRED_LANGUAGE]),    	
    ];
});


function generate_user_id()
{
    $user_id = User::all()->random()->user_id;

    if(!Partner::where('user_id', $user_id)->get()->count() > 0)
        generate_user_id();
    return $user_id;
}
