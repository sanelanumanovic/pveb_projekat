<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('menu', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 64);
			$table->decimal('price', 10, 2);
			$table->boolean('for_two')->default(false);
			$table->boolean('active')->default(true);
			$table->longText('description');
			$table->binary('image');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('menu');
	}

}
