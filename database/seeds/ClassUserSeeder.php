<?php

use Illuminate\Database\Seeder;

class ClassUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $class_ids=\App\Models\Classes::all()->pluck('id')->toArray();

        $user_ids=\App\Models\User::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);
        $classusers = factory(\App\Models\ClassUser::class)
            ->times(500)
            ->make()
            ->each(function ($classusers, $index)
            use ($user_ids, $class_ids, $faker)
            {
                $classusers->user_id = $faker->randomElement($user_ids);
                $classusers->class_id=$faker->randomElement($class_ids);
            });


        \App\Models\ClassUser::insert($classusers->toArray());
    }
}
