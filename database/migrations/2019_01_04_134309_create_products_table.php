<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->integer('id')->primary();
			$table->integer('category_id')->unsigned();
			$table->string('name');
			$table->double('price');
			$table->integer('unit_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
