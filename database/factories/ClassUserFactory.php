<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\ClassUser::class, function (Faker $faker) {
    return [
        'token'=>null,
        $faker->unique()
    ];
});
