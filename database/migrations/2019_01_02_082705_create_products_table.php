<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->integer('id')->primary();
			$table->tinyInteger('category_id');
			$table->string('name');
			$table->double('price');
			$table->tinyInteger('unit_id');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
