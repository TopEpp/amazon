<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImportsTable extends Migration {

	public function up()
	{
		Schema::create('imports', function(Blueprint $table) {
			$table->integer('id')->primary();
			$table->tinyInteger('user_id');
			$table->tinyInteger('product_id');
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
