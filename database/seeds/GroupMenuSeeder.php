<?php

use Illuminate\Database\Seeder;

class GroupMenuSeeder extends Seeder
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
                        'menu' => '1',
                        'group' => '1',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'menu' => '2',
                        'group' => '1',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'menu' => '3',
                        'group' => '1',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'menu' => '4',
                        'group' => '1',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'menu' => '5',
                        'group' => '1',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'menu' => '6',
                        'group' => '1',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'menu' => '7',
                        'group' => '1',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'menu' => '8',
                        'group' => '1',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'menu' => '9',
                        'group' => '1',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'menu' => '10',
                        'group' => '1',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ],
                    [
                        'menu' => '1',
                        'group' => '2',
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ]
            ];
        DB::table('group_menu')->insert($data);
    }
}
