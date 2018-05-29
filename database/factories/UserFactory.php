<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "lname" => $faker->name,
        "email" => $faker->safeEmail,
        "address" => $faker->name,
        "suburb" => $faker->name,
        "state" => $faker->name,
        "postcode" => $faker->name,
        "phone" => $faker->name,
        "password" => str_random(10),
        "remember_token" => $faker->name,
    ];
});
