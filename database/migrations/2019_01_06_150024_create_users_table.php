<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->longText('address')->nullable();
            $table->longText('address_stock')->nullable();
            $table->tinyInteger('type')->default(1);
            $table->boolean('status')->default(true);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
