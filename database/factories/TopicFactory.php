<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {
    $sentence = $faker->sentence();

    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);

    return [
        'title' => $sentence,
        'content' => clean($faker->text()),
        'level'=>1,
        'can_reply'=>1,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
