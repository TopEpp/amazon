<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStocksTable extends Migration {

	public function up()
	{
		Schema::create('stocks', function(Blueprint $table) {
			$table->integer('id')->primary();
			$table->integer('product_id');
			$table->tinyInteger('categoty_id');
			$table->integer('value');
			$table->integer('user_id');
			$table->integer('order_id');
			$table->integer('import_id');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('stocks');
	}
}
