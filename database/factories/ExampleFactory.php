<?php

/** @var Factory $factory */

use App\Models\Example;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(
    Example::class,
    function (Faker $faker) {
        return [
            'string' => $faker->name,
            'integer' => $faker->randomNumber(),
            'text' => $faker->text(100),
        ];
    }
);
