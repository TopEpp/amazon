<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImportsTable extends Migration {

	public function up()
	{
		Schema::create('imports', function(Blueprint $table) {
			$table->increments('id', true)->primary();
			$table->integer('user_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->integer('value');
			$table->date('date');
			$table->double('price');
			$table->string('remark');
			$table->tinyInteger('import_status');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('imports');
	}
}
