<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(TagsTableSeeder::class);
        // $this->call(ArticlesTableSeeder::class);
        // $this->call(ImagesTableSeeder::class);
        // $this->call(ArticlesTagsTableSeeder::class);
        // $this->call(LikesTableSeeder::class);
        // $this->call(ComentsTableSeeder::class);
        
        Model::reguard();
    }
}
