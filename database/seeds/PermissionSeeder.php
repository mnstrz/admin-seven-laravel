<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
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
                        'name' => 'config-menu',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'id' => '2',
                        'name' => 'config-user',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'id' => '3',
                        'name' => 'config-group',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'id' => '4',
                        'name' => 'config-permission',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'id' => '5',
                        'name' => 'dashboard',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ]
                ];
        DB::table('permission')->insert($data);
    }
}
