<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
          \DB::table('users')->insert(array(

                'name'          => 'SuperAdmin',
                'email'         => 'superadmin@gmail.com',
                'password'      => bcrypt('superadmin'),
                'type'          => 'superadmin',
                'img_user'      => 'super_admin.jpg',
                'img_bio'       => 'portada.jpg',
                'sex'           => 'Masculino',
                'created_at'    => Carbon\Carbon::now(),
                'updated_at'    => Carbon\Carbon::now()
            ));
            \DB::table('users')->insert(array(

                'name'          => 'Administrador',
                'email'         => 'admin@gmail.com',
                'password'      => bcrypt('admin'),
                'type'          => 'admin',
                'img_user'      => 'admin.jpg',
                'sex'           => 'Masculino',
                'created_at'    => Carbon\Carbon::now(),
                'updated_at'    => Carbon\Carbon::now()
            ));
        //factory(App\User::class,50)->create();
    }
}
