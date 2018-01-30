<?php

class OrderProductTableSeeder extends Seeder {

	public function run() {
		DB::table('order_products')->delete();
		
		OrderProduct::create(array(
		 	'order_id' => 1, 
		 	'menu_id' => 1,
		 	'quantity' => 1,
		 	'price' => '500'
	 	));

	   OrderProduct::create(array(
		 	'order_id' => 1, 
		 	'menu_id' => 2,
		 	'quantity' => 2,
		 	'price' => '650'
	 	));

	   OrderProduct::create(array(
		 	'order_id' => 2, 
		 	'menu_id' => 2,
		 	'quantity' => 1,
		 	'price' => '650'
	 	));

	   OrderProduct::create(array(
		 	'order_id' => 3, 
		 	'menu_id' => 1,
		 	'quantity' => 1,
		 	'price' => '500'
	 	));

	   OrderProduct::create(array(
		 	'order_id' => 4, 
		 	'menu_id' => 1,
		 	'quantity' => 2,
		 	'price' => '500'
	 	));

	   OrderProduct::create(array(
		 	'order_id' => 5, 
		 	'menu_id' => 2,
		 	'quantity' => 3,
		 	'price' => '650'
	 	));

	    OrderProduct::create(array(
		 	'order_id' => 6, 
		 	'menu_id' => 2,
		 	'quantity' => 3,
		 	'price' => '650'
	 	));

	 	OrderProduct::create(array(
		 	'order_id' => 7, 
		 	'menu_id' => 2,
		 	'quantity' => 1,
		 	'price' => '650'
	 	));

	 	OrderProduct::create(array(
		 	'order_id' => 7, 
		 	'menu_id' => 1,
		 	'quantity' => 1,
		 	'price' => '500'
	 	));
	}
}