<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transfer;
use Faker\Generator as Faker;

$factory->define(Transfer::class, function (Faker $faker) {
    return [
        //
        'description' => $faker->text($maxNbChars = 200),
        'amount' =>  $faker->numberBetween($min = 10, $max = 90),
        'wallet_id' => $faker->randomDigitNotNull
    ];
});
