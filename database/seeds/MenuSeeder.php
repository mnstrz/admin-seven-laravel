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
        $json = '[
                  {
                    "id": 1,
                    "parent": null,
                    "name": "Dashboard",
                    "url": "/",
                    "icon": "fas fa-tachometer-alt",
                    "sort": 1,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 2,
                    "parent": null,
                    "name": "Configurations",
                    "url": "#!",
                    "icon": "fas fa-cog",
                    "sort": 12,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 3,
                    "parent": null,
                    "name": "Template",
                    "url": "#!",
                    "icon": "fas fa-clipboard",
                    "sort": 13,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 4,
                    "parent": 2,
                    "name": "User",
                    "url": "user",
                    "icon": "fas fa-user",
                    "sort": 5,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 5,
                    "parent": 2,
                    "name": "Permission",
                    "url": "permission",
                    "icon": "fas fa-key",
                    "sort": 6,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 6,
                    "parent": 2,
                    "name": "Group",
                    "url": "group",
                    "icon": "fas fa-users",
                    "sort": 7,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 7,
                    "parent": 2,
                    "name": "Menu",
                    "url": "menu",
                    "icon": "fas fa-list",
                    "sort": 11,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 8,
                    "parent": 3,
                    "name": "Form",
                    "url": "template/form",
                    "icon": "far fa-circle",
                    "sort": 8,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 9,
                    "parent": 3,
                    "name": "Table",
                    "url": "template/table",
                    "icon": "far fa-circle",
                    "sort": 10,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 10,
                    "parent": 3,
                    "name": "Form Collective",
                    "url": "template/form-collective",
                    "icon": "far fa-circle",
                    "sort": 9,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 16,
                    "parent": 2,
                    "name": "Theme",
                    "url": "theming",
                    "icon": "fas fa-palette",
                    "sort": 14,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 18,
                    "parent": null,
                    "name": "Creator",
                    "url": "creator",
                    "icon": "fa fa-magic",
                    "sort": 3,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 21,
                    "parent": null,
                    "name": "Sample Creator",
                    "url": "sample-creator/creator",
                    "icon": "fas fa-puzzle-piece",
                    "sort": 2,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  },
                  {
                    "id": 22,
                    "parent": 2,
                    "name": "Application",
                    "url": "configuration",
                    "icon": "fas fa-wrench",
                    "sort": 4,
                    "created_at": "2021-01-01 00:00:00",
                    "updated_at": "2021-01-01 00:00:00"
                  }
                ]';
        $data = json_decode($json,true);
        DB::table('menu')->insert($data);
    }
}
