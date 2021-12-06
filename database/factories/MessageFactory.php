<?php

use App\Models\Topic;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use App\Models\Message;

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
$factory->define(Message::class, function (Faker $faker) {
    return [
        'topic_id' => function () {
            return Topic::all()->first()->id;
        },
        'parent_id' => null,
        'body' => $faker->text,
        'is_highlight' => $faker->boolean,
        'user_id' => function () {
            return User::all()->random()->id;
        },
    ];
});
