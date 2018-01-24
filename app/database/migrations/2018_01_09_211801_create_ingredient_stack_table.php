<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientStackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('ingredient_stack', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('ingredient_id');
			$table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');

			$table->decimal('quantity', 9, 2);

			$table->unsignedInteger('measurement_unit_id');
			$table->foreign('measurement_unit_id')->references('id')->on('measurement_units');

			$table->date('expiration_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('ingredient_stack');
	}
}
