<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->integer('id')->primary();
			$table->integer('user_id');
			$table->integer('product_id');
			$table->integer('value');
			$table->date('date');
			$table->double('price');
			$table->longText('remark');
			$table->tinyInteger('order_status');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
