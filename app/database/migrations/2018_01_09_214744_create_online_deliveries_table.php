<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlineDeliveriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('online_deliveries', function(Blueprint $table) {
			$table->increments('id');

			$table->unsignedInteger('order_id');
			$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

			$table->unsignedInteger('supplier_id');
			$table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

			$table->longText('address');
			$table->longText('contact');
			$table->longText('comment')->nullable();
			$table->date('delivery_time')->nullable();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('online_deliveries');
	}


}
