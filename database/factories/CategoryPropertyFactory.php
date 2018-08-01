<?php

use Faker\Generator as Faker;

$factory->define(App\CategoryProperty::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2, true),
    ];
});
