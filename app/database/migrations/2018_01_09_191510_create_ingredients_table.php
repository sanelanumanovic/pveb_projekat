<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('ingredients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 64);
			$table->integer('min_quantity');
			$table->boolean('gluten')->default(false);
			$table->boolean('vegan')->default(false);
			$table->boolean('allergen')->default(false);
			$table->boolean('lenten')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('ingredients');
	}


}
