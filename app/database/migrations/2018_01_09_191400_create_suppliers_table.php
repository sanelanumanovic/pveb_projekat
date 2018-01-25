<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('suppliers', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 128);
			$table->string('pib', 16);
			$table->string('description', 64);
			$table->string('account', 32);
			$table->string('phone', 13);
			$table->string('fax', 13)->nullable();
			$table->string('email', 64)->nullable();
			$table->longText('comment', 64)->nullable();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('suppliers');
	}
}
