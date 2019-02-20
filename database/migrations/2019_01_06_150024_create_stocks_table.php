<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStocksTable extends Migration
{

    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('categoty_id')->unsigned();
            $table->integer('value')->nullable();
            $table->integer('user_id')->unsigned();
            // $table->integer('order_id')->unsigned();
            // $table->integer('import_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('stocks');
    }
}
