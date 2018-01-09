<?php

class SupplierTableSeeder extends Seeder {

	public function run() {
		DB::table('suppliers')->delete();
		
		Supplier::create(array(
		 	'name' => 'Maxi online', 
		 	'pib' => '123456987', 
		 	'description' => '',
		 	'account' => '9874563211236',
		 	'phone' => '011123456'
	 	));
	}
}