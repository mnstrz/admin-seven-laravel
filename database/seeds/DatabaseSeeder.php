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
        $this->call([
            GroupSeeder::class,
            MenuSeeder::class,
            PermissionSeeder::class,
            UsersTableSeeder::class,
            GroupMenuSeeder::class,
            GroupPermissionSeeder::class,
            FakeTableSeeder::class
        ]);
    }
}
