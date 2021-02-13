<?php

use Illuminate\Database\Seeder;

class GroupPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = '[
                  {
                    "id": 1,
                    "group": 2,
                    "permission": 5,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 2,
                    "group": 1,
                    "permission": 5,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 3,
                    "group": 1,
                    "permission": 2,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 4,
                    "group": 1,
                    "permission": 3,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 5,
                    "group": 1,
                    "permission": 4,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 6,
                    "group": 1,
                    "permission": 16,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 7,
                    "group": 2,
                    "permission": 1,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 8,
                    "group": 1,
                    "permission": 1,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 9,
                    "group": 2,
                    "permission": 17,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 10,
                    "group": 1,
                    "permission": 17,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 11,
                    "group": 1,
                    "permission": 18,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  }
                ]';
        $data = json_decode($json,true);
        DB::table('group_permission')->insert($data);
    }
}
