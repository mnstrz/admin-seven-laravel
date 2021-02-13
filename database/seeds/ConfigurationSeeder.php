<?php

use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
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
				    "app_name": "Admin Seven",
				    "website_domain": "adminseven.com",
				    "smtp_mail_server": null,
				    "smtp_mail_port": null,
				    "smtp_mail_username": null,
				    "smtp_mail_password": null,
				    "smtp_mail_name": null,
				    "smtp_mail_address": null,
				    "created_at": "2021-01-01 00:00:00",
				    "updated_at": "2021-01-01 00:00:00"
				  }
				]';
        $data = json_decode($json,true);
        DB::table('configuration')->insert($data);
    }
}
