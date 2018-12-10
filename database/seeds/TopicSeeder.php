<?php

use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = \App\Models\User::all()->pluck('id')->toArray();

        $type_ids = \App\Models\TopicType::all()->pluck('id')->toArray();

        $class_ids=\App\Models\Classes::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);

        $topics = factory(\App\Models\Topic::class)
            ->times(1000)
            ->make()
            ->each(function ($topic, $index)
            use ($user_ids, $type_ids,$class_ids, $faker)
            {
                $topic->user_id = $faker->randomElement($user_ids);
                $topic->class_id=$faker->randomElement($class_ids);
                $topic->type_id = $faker->randomElement($type_ids);
            });

        \App\Models\Topic::insert($topics->toArray());
    }
}
