<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                    [
                        'id' => '1',
                        'username' => 'superadministrator',
                        'group' => '1',
                        'email' => 'superadministrator@backend.com',
                        'password' => bcrypt('12345678'),
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'id' => '2',
                        'username' => 'admin',
                        'group' => '1',
                        'email' => 'admin@admin.com',
                        'password' => bcrypt('12345678'),
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ]
                ];
        DB::table('users')->insert($data);
    }
}