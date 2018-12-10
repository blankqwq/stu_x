<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Classes::class, function (Faker $faker) {

    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);
    return [
        'name'=>$faker->name,
        'numbers'=>0,
        'verification'=>1,
        'password'=>'123',
        'updated_at'=>$updated_at,
        'created_at'=>$created_at
    ];
});
