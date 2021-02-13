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
        $json = '[
                  {
                    "id": 1,
                    "group": 1,
                    "menu": 5,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 2,
                    "group": 1,
                    "menu": 6,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 3,
                    "group": 1,
                    "menu": 7,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 4,
                    "group": 1,
                    "menu": 3,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 5,
                    "group": 1,
                    "menu": 16,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 6,
                    "group": 1,
                    "menu": 8,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 7,
                    "group": 1,
                    "menu": 9,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 8,
                    "group": 1,
                    "menu": 10,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 9,
                    "group": 1,
                    "menu": 1,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 10,
                    "group": 2,
                    "menu": 1,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 11,
                    "group": 2,
                    "menu": 2,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 12,
                    "group": 1,
                    "menu": 2,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 13,
                    "group": 1,
                    "menu": 4,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 14,
                    "group": 1,
                    "menu": 21,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 15,
                    "group": 1,
                    "menu": 18,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 16,
                    "group": 1,
                    "menu": 22,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  }
                ]';
        $data = json_decode($json,true);
        DB::table('group_menu')->insert($data);
    }
}
