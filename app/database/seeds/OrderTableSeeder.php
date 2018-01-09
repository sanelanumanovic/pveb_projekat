<?php

class OrderTableSeeder extends Seeder {

	public function run() {
		DB::table('orders')->delete();
		
		Order::create(array(
		 	'creation_date' => '2017-09-25', 
		 	'completion_date' => '2017-09-25', 
		 	'status' => '1',
		 	'user_id' => 1
	 	));

	 	Order::create(array(
		 	'creation_date' => '2017-11-20', 
		 	'completion_date' => '2017-11-20', 
		 	'status' => '1',
		 	'user_id' => 1
	 	));

	 	Order::create(array(
		 	'creation_date' => '2017-12-21', 
		 	'completion_date' => '2017-12-21', 
		 	'status' => '1',
		 	'user_id' => 1
	 	));

	 	Order::create(array(
		 	'creation_date' => '2017-12-22', 
		 	'completion_date' => '2017-12-22', 
		 	'status' => '1',
		 	'user_id' => 1
	 	));

	 	Order::create(array(
		 	'creation_date' => '2018-01-03', 
		 	'completion_date' => '2018-01-03', 
		 	'status' => '1',
		 	'user_id' => 1
	 	));

	 	Order::create(array(
		 	'creation_date' => '2018-01-03', 
		 	'completion_date' => '2018-01-03', 
		 	'status' => '1',
		 	'user_id' => 1
	 	));

	 	Order::create(array(
		 	'creation_date' => '2018-01-05', 
		 	'completion_date' => '2018-01-05', 
		 	'status' => '1',
		 	'user_id' => 1
	 	));
	}
}