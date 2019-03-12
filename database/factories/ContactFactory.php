<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'picture' => 'https://www.startupdelta.org/wp-content/uploads/2018/04/No-profile-LinkedIn.jpg'
    ];
});
