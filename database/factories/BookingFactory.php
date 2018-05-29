<?php

$factory->define(App\Booking::class, function (Faker\Generator $faker) {
    return [
        "user_id" => factory('App\User')->create(),
        "requesting_id" => factory('App\Requesting')->create(),
        "date" => $faker->date("d-m-Y H:i:s", $max = 'now'),
        "installer" => $faker->name,
        "model_no" => $faker->name,
        "serial_no" => $faker->name,
        "type" => collect(["Domestic","Commercail",])->random(),
        "ladder_required" => 0,
        "assing_to" => $faker->name,
    ];
});
