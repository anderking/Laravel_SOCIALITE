<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();

    	for ($i=0; $i < 1000 ; $i++)
    	{ 
    		\DB::table('likes')->insert(array(

    			'article_id' 	=> $faker->biasedNumberBetween($min = 1, $max = 200, $function = 'sqrt'),
    			'user_id'			=> $faker->biasedNumberBetween($min = 3, $max = 52, $function = 'sqrt'),
                'created_at' => $faker->dateTimeBetween($startDate = '0 years', $endDate = 'now'),
                'updated_at' => $faker->dateTimeBetween($startDate = '0 years', $endDate = 'now')
    		));
    	}
    }
}
