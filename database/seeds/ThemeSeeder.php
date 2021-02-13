<?php

use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
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
				    "navbar_skin": "bg-navy",
				    "sidebar_skin": "light bg-navy",
				    "brand_skin": "bg-navy",
				    "accent_skin": "bg-orange",
				    "card_skin": "bg-navy",
				    "created_at": "2021-01-01 00:00:00",
				    "updated_at": "2021-01-01 00:00:00",
				    "is_no_navbar_border": 0,
				    "is_body_small": 1,
				    "is_navbar_small": 1,
				    "is_sidebar_small": 1,
				    "is_footer_small": 1,
				    "is_sidebar_flat": 0,
				    "is_sidebar_legacy": 0,
				    "is_sidebar_compact": 0,
				    "is_sidebar_child_indent": 1,
				    "is_sidebar_child_hide": 0,
				    "is_sidebar_disable_expand": 0,
				    "is_brand_small": 0,
				    "is_fixed_navbar": 1,
				    "is_fixed_footer": 1,
				    "is_sidebar_default_collapse": 0,
				    "is_boxed": 0,
				    "is_fixed_sidebar": 1,
				    "is_top_nav": 0
				  }
				]';
        $data = json_decode($json,true);
        DB::table('theme')->insert($data);
    }
}
