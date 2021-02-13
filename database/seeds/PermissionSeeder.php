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
        $json = '[
                  {
                    "id": 1,
                    "name": "config-menu",
                    "url": "menu",
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 2,
                    "name": "config-user",
                    "url": "user",
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 3,
                    "name": "config-group",
                    "url": "group",
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 4,
                    "name": "config-permission",
                    "url": "permission",
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 5,
                    "name": "dashboard",
                    "url": "",
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 16,
                    "name": "sample-creator",
                    "url": "sample-creator/creator",
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 17,
                    "name": "creator",
                    "url": "creator",
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 18,
                    "name": "configuration",
                    "url": "configuration",
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  }
                ]';
        $data = json_decode($json,true);
        DB::table('permission')->insert($data);
    }
}
