<?php

use Illuminate\Database\Seeder;
use \App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=new User();
        $user->email="1136589038@qq.com";
        $user->password=bcrypt("123456");
        $user->sex='男';
        $user->name='blank';
        $user->save();
        $user->assignRole('master');
    }
}
