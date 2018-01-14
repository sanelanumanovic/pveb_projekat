<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('order_products', function(Blueprint $table) {

			$table->unsignedInteger('order_id');
			$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

			$table->unsignedInteger('menu_id');
			$table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');

			$table->tinyInteger('quantity');

			$table->primary(['order_id', 'menu_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('order_products');
	}

}
