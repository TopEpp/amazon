<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategorysTable extends Migration {

	public function up()
	{
		Schema::create('categorys', function(Blueprint $table) {
			$table->integer('id')->primary();
			$table->string('name');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('categorys');
	}
}
