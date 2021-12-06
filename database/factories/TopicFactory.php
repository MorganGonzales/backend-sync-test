<?php

use App\Models\Section;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use App\Models\Topic;

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

/**
 * @var Factory $factory
 */
$factory->define(Topic::class, function (Faker $faker) {
    return [
        'section_id' => function () {
            return Section::all()->random()->id;
        },
        'title' => $faker->word,
        'body' => $faker->text,
        'user_id' => function () {
            return User::all()->random()->id;
        },
    ];
});
