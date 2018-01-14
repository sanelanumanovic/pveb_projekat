<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('menu_items', function(Blueprint $table) {
			$table->unsignedInteger('ingredient_id');
			$table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');

			$table->unsignedInteger('menu_id');
			$table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');

			$table->decimal('quantity', 9, 2);

			$table->unsignedInteger('measurement_unit_id');
			$table->foreign('measurement_unit_id')->references('id')->on('measurement_units');

			$table->primary(['menu_id', 'ingredient_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('menu_items');
	}

}
