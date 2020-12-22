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

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->name();

    return [
        'title' => $title,
        'body' => $faker->text(),
        'slug' => App\Post::saltSlug(App\Post::slugifyTitle($title)),
        'developer_id' => $faker->randomElement([1,2]),
        'channel_id' => $faker->randomElement([1,2]),
    ];
});
