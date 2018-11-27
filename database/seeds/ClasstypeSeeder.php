<?php

use Illuminate\Database\Seeder;
use \App\Models\ClassType;
class ClasstypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type=new ClassType();
        $type->category="班级";
        $type->save();

        $type=new ClassType();
        $type->category="社团";
        $type->save();

    }
}
