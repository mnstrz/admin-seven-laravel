<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
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
                        'name' => 'Dashboard',
                        'parent' => null,
                        'url' => '/',
                        'icon' => 'dashboard',
                        'sort' => 1,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'id' => '2',
                        'name' => 'Data Master',
                        'parent' => null,
                        'url' => '#!',
                        'icon' => 'database',
                        'sort' => 2,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'id' => '3',
                        'name' => 'Template',
                        'parent' => null,
                        'url' => '#!',
                        'icon' => 'circle',
                        'sort' => 3,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'id' => '4',
                        'name' => 'User',
                        'parent' => 2,
                        'url' => 'user',
                        'icon' => 'user',
                        'sort' => 4,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'id' => '5',
                        'name' => 'Permission',
                        'parent' => 2,
                        'url' => 'permission',
                        'icon' => 'key',
                        'sort' => 5,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'id' => '6',
                        'name' => 'Group',
                        'parent' => 2,
                        'url' => 'group',
                        'icon' => 'users',
                        'sort' => 6,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'id' => '7',
                        'name' => 'Menu',
                        'parent' => 2,
                        'url' => 'menu',
                        'icon' => 'list',
                        'sort' => 7,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'id' => '8',
                        'name' => 'Form',
                        'parent' => 3,
                        'url' => 'form',
                        'icon' => 'circle-o',
                        'sort' => 8,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'id' => '9',
                        'name' => 'Table',
                        'parent' => 3,
                        'url' => 'table',
                        'icon' => 'circle-o',
                        'sort' => 9,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'id' => '10',
                        'name' => 'Document Editor',
                        'parent' => 3,
                        'url' => 'document',
                        'icon' => 'circle-o',
                        'sort' => 10,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ]
                ];
        DB::table('menu')->insert($data);
    }
}
