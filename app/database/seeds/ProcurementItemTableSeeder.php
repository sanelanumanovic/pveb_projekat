<?php

class ProcurementItemTableSeeder extends Seeder {
	public function run() {
		DB::table('procurement_items')->delete();

		ProcurementItem::create(array(
		 	'procurement_id' => 1, 
		 	'ingredient_id' => 1, 
		 	'measurement_unit_id' => 2,
		 	'price' => 50,
		 	'quantity' => 500
	 	));

	 	ProcurementItem::create(array(
		 	'procurement_id' => 1, 
		 	'ingredient_id' => 2, 
		 	'measurement_unit_id' => 2,
		 	'price' => 40,
		 	'quantity' => 100
	 	));


	 	ProcurementItem::create(array(
		 	'procurement_id' => 1, 
		 	'ingredient_id' => 5, 
		 	'measurement_unit_id' => 2,
		 	'price' => 95,
		 	'quantity' => 20
	 	));

	 	ProcurementItem::create(array(
		 	'procurement_id' => 3, 
		 	'ingredient_id' => 2, 
		 	'measurement_unit_id' => 2,
		 	'price' => 40,
		 	'quantity' => 100
	 	));

	 	ProcurementItem::create(array(
		 	'procurement_id' => 3, 
		 	'ingredient_id' => 1, 
		 	'measurement_unit_id' => 2,
		 	'price' => 50,
		 	'quantity' => 120
	 	));


	 	ProcurementItem::create(array(
		 	'procurement_id' => 5, 
		 	'ingredient_id' => 4, 
		 	'measurement_unit_id' => 2,
		 	'price' => 120,
		 	'quantity' => 40
	 	));

	 	ProcurementItem::create(array(
		 	'procurement_id' => 5, 
		 	'ingredient_id' => 3, 
		 	'measurement_unit_id' => 2,
		 	'price' => 220,
		 	'quantity' => 70
	 	));


	}

}