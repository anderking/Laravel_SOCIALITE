<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->enum('type',['member','admin','superadmin'])->default('member');
            $table->string('img_user')->default('user.jpg');
            $table->string('img_bio');
            $table->text('bio_description');
            $table->string('sex');
            $table->date('fecha')->default(date('Y-m-d'));
            $table->string('address');
            $table->string('phone');
            $table->string('work');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('instagram');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
