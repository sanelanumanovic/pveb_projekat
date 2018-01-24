<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementInventoryItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('procurement_inventory_items', function(Blueprint $table) {
			$table->unsignedInteger('procurement_id');
			$table->foreign('procurement_id')->references('id')->on('procurements')->onDelete('cascade');

			$table->unsignedInteger('inventory_id');
			$table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');

			$table->unsignedInteger('measurement_unit_id');
			$table->foreign('measurement_unit_id')->references('id')->on('measurement_units')->onDelete('cascade');

			$table->decimal('price', 10, 2);
			$table->integer('quantity');

			$table->primary(['procurement_id', 'inventory_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('procurement_inventory_items');
	}

}
