<?php

$factory->define(App\Requesting::class, function (Faker\Generator $faker) {
    return [
        "user_id" => factory('App\User')->create(),
        "pref_day" => collect(["Monday","Tuesday","Wednesday","Thursday ","Friday",])->random(),
        "desc" => $faker->name,
    ];
});
