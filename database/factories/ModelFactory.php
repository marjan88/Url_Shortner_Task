<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => app('hash')->make('secret'),
    ];
});

$factory->define(App\Models\Link::class, function (Faker\Generator $faker) {
    return [
        'original_url' => $faker->url,
        'user_id' => factory(App\Models\User::class),
    ];
});
