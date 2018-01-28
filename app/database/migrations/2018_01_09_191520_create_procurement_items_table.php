<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('procurement_items', function(Blueprint $table) {
			$table->integer('procurement_id');
			$table->foreign('procurement_id')->references('id')->on('procurements')->onDelete('cascade');

			$table->integer('ingredient_id');
			$table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');

			$table->integer('measurement_unit_id');
			$table->foreign('measurement_unit_id')->references('id')->on('measurement_units')->onDelete('cascade');

			$table->decimal('price', 10, 2);
			$table->integer('quantity');

			$table->primary(['procurement_id', 'ingredient_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('procurement_items');
	}


}
