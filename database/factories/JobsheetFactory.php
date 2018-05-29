<?php

$factory->define(App\Jobsheet::class, function (Faker\Generator $faker) {
    return [
        "booking_id" => factory('App\Booking')->create(),
        "user_id" => factory('App\User')->create(),
        "requesting_id" => factory('App\Requesting')->create(),
        "finish_date" => $faker->date("d-m-Y H:i:s", $max = 'now'),
        "diagnose" => $faker->name,
        "add_info" => $faker->name,
    ];
});
