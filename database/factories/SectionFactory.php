<?php

use App\Models\Section;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/**
 * @var Factory $factory
 */
$factory->define(Section::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
