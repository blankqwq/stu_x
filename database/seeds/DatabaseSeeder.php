<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TopicTypeSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ClasstypeSeeder::class);

        $this->call(ClassesSeeder::class);
        $this->call(TopicSeeder::class);

        $this->call(ClassUserSeeder::class);
    }
}
