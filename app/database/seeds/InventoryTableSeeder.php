<?php

class InventoryTableSeeder extends Seeder {

	public function run() {
		DB::table('inventories')->delete();
		
		Inventory::create(array(
		 	'name' => 'Barska stolica', 
		 	'quantity' => 20,
		 	'min_quantity' => 15,
		 	'description' => 'crna'
	 	));

	 	Inventory::create(array(
		 	'name' => 'Barska stolica siva', 
		 	'quantity' => 21,
		 	'min_quantity' => 15,
		 	'description' => 'siva'
	 	));

	 	Inventory::create(array(
		 	'name' => 'Mali sto', 
		 	'quantity' => 11,
		 	'min_quantity' => 5,
		 	'description' => ''
	 	));
	}
}