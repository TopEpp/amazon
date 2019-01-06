<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImportItemsTable extends Migration
{

    public function up()
    {
        Schema::create('import_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('import_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('stock_id')->unsigned();
            $table->integer('value');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('import_items');
    }
}
