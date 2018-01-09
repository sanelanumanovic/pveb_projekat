<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('salaries', function(Blueprint $table) {
			$table->increments('id');
			$table->date('payment_date');
			$table->decimal('amount', 10, 2);
			$table->longText('description');

			$table->integer('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('salaries');
	}


}
