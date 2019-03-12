<?php

use Faker\Generator as Faker;

$factory->define(App\Phone::class, function (Faker $faker) {
    return [
        'phone' => $faker->e164PhoneNumber
    ];
});
