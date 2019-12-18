<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Poll;
use Illuminate\Support\Str;
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

$factory->define(Poll::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'ip' => '127.0.0.1',
        'agent' => 'agent',
        'created_at' => now(),
    ];
});
