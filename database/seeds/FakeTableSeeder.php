<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FakeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create('id_ID');
    	for($i = 1; $i <= 50; $i++){
	        DB::table('fake_table')->insert([
	            'name' => $faker->name,
	            'email' => $faker->email,
	            'address' => $faker->address,
	            'phone' => $faker->phoneNumber,
	            'created_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
	            'updated_at' => $faker->dateTimeThisYear($max = 'now', $timezone = null)
	        ]);
	    }
    }
}
