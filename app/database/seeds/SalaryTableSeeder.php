<?php

class SalaryTableSeeder extends Seeder {

	public function run() {
		DB::table('salaries')->delete();
		
		Salary::create(array(
		 	'payment_date' => '2017-09-01', 
		 	'amount' => '20000', 
		 	'user_id' => 1
	 	));

	 	Salary::create(array(
		 	'payment_date' => '2017-10-01', 
		 	'amount' => '20000', 
		 	'user_id' => 1
	 	));

	 	Salary::create(array(
		 	'payment_date' => '2017-11-01', 
		 	'amount' => '20000', 
		 	'user_id' => 1
	 	));

	 	Salary::create(array(
		 	'payment_date' => '2017-12-01', 
		 	'amount' => '20000', 
		 	'user_id' => 1
	 	));

	 	Salary::create(array(
		 	'payment_date' => '2018-01-01', 
		 	'amount' => '20000', 
		 	'user_id' => 1
	 	));

	 
	}
}