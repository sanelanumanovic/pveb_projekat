<?php

class ProcurementTableSeeder extends Seeder {
	public function run() {
		DB::table('procurements')->delete();

		Procurement::create(array(
		 	'creation_date' => '2017-09-15', 
		 	'completion_date' => '2017-09-15', 
		 	'user_id' => 1,
		 	'supplier_id' => 1
	 	));

	 	Procurement::create(array(
		 	'creation_date' => '2017-09-20', 
		 	'completion_date' => '2017-09-20', 
		 	'user_id' => 1,
		 	'supplier_id' => 1
	 	));

	 	Procurement::create(array(
		 	'creation_date' => '2017-10-15', 
		 	'completion_date' => '2017-10-15', 
		 	'user_id' => 1,
		 	'supplier_id' => 1
	 	));

	 	Procurement::create(array(
		 	'creation_date' => '2017-12-15', 
		 	'completion_date' => '2017-12-15', 
		 	'user_id' => 1,
		 	'supplier_id' => 1
	 	));

	 	Procurement::create(array(
		 	'creation_date' => '2017-12-25', 
		 	'completion_date' => '2017-12-26', 
		 	'user_id' => 1,
		 	'supplier_id' => 1
	 	));

	}

}