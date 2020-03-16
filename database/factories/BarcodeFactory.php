<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Barcode;
use Faker\Generator as Faker;

$factory->define(Barcode::class, function (Faker $faker) {
    return [
        'barcode' => $faker->numberBetween(10000000, 500000000),
    ];
});
