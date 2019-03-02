<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ArticlesTagsTableSeeder extends Seeder
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
    		\DB::table('article_tag')->insert(array(

    			'article_id' 	=> $faker->biasedNumberBetween($min = 1, $max = 200, $function = 'sqrt'),
    			'tag_id'			=> $faker->biasedNumberBetween($min = 1, $max = 50, $function = 'sqrt')
    		));
    	}
    }
}
