<?php

use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = \App\Models\User::all()->pluck('id')->toArray();
        $type_ids=\App\Models\ClassType::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);

        $classes = factory(\App\Models\Classes::class)
            ->times(100)
            ->make()
            ->each(function ($classes, $index)
            use ($user_ids,$type_ids, $faker)
            {
                $classes->user_id = $faker->randomElement($user_ids);
                $classes->type_id=$faker->randomElement($type_ids);
                $classes->user_allow=$faker->randomElement($user_ids);
            });

        \App\Models\Classes::insert($classes->toArray());
    }
}
