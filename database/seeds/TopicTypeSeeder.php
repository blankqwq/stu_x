<?php

use Illuminate\Database\Seeder;

class TopicTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!\App\Models\TopicType::find(1)){
            $notice=new \App\Models\TopicType();

            $notice->name="公告";

            $notice->save();
        }


        if (!\App\Models\TopicType::find(2)){

            $need=new \App\Models\TopicType();

            $need->name="需求";

            $need->save();
        }

    }
}
