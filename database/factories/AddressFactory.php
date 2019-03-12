<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    $address = str_replace(',', ',<br />', $faker->address);
    return compact('address');
});
