<?php

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

$factory->define(App\Developer::class, function (Faker $faker) {
    return [
        'email' => $faker->unique->safeEmail(),
        'username' => $faker->userName(),
        'twitter_handle' => $faker->domainName(),
        'admin' => $faker->boolean($chanceOfGettingTrue = 50),
        'editor' => 'Text Field',
    ];
});
