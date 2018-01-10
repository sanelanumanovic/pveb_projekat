<?php

class ProcurementInventoryItemTableSeeder extends Seeder {
	public function run() {
		DB::table('procurement_inventory_items')->delete();

		ProcurementInventoryItem::create(array(
		 	'procurement_id' => 2, 
		 	'inventory_id' => 1, 
		 	'measurement_unit_id' => 1,
		 	'price' => 900,
		 	'quantity' => 10
	 	));

	 	ProcurementInventoryItem::create(array(
		 	'procurement_id' => 2, 
		 	'inventory_id' => 2, 
		 	'measurement_unit_id' => 1,
		 	'price' => 1250,
		 	'quantity' => 10
	 	));
	 	ProcurementInventoryItem::create(array(
		 	'procurement_id' => 4, 
		 	'inventory_id' => 2, 
		 	'measurement_unit_id' => 1,
		 	'price' => 1200,
		 	'quantity' => 10
	 	));

	 	ProcurementInventoryItem::create(array(
		 	'procurement_id' => 4, 
		 	'inventory_id' => 3, 
		 	'measurement_unit_id' => 1,
		 	'price' => 2100,
		 	'quantity' => 5
	 	));
	}

}