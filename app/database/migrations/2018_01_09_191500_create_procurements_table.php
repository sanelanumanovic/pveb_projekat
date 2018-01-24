<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('procurements', function(Blueprint $table) {
			$table->increments('id');
			$table->date('creation_date');
			$table->date('completion_date')->nullable();
			$table->date('termination_date')->nullable();
			$table->string('termination_note', 100)->nullable();

			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->unsignedInteger('supplier_id');
			$table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('procurements');
	}

}
