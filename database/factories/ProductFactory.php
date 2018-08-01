<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2, true),
        'price' => $faker->numberBetween(0,5000)
    ];
});
