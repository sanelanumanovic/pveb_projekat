<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasurementUnitsTable extends Migration {

/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('measurement_units', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 20);
			$table->string('short_name', 6);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('measurement_units');
	}
}
