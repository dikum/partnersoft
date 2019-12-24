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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'type' => $type,
        'branch' => $faker->randomElement([User::LAGOS_BRANCH, User::SOUTH_AFRICA_BRANCH, User::GHANA_BRANCH]),
        'remember_token' => str_random(10),
    	'verified' => $verified =  $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]),
    	'verification_token' => $verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),
    ];
});
