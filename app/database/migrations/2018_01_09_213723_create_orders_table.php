<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');

			$table->date('creation_date');
			$table->date('completion_date')->nullable();

			$table->string('status', 32);

			$table->integer('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->decimal('total', 10, 2);

			$table->integer('table_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('orders');
	}

}
