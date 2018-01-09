<?php

class MenuItemTableSeeder extends Seeder {

	public function run() {
		DB::table('menu_items')->delete();
		
		MenuItem::create(array(
		 	'ingredient_id' => 1, 
		 	'menu_id' => 1,
		 	'quantity' => 200,
		 	'measurement_unit_id' => 4
	 	));

	    MenuItem::create(array(
		 	'ingredient_id' => 2, 
		 	'menu_id' => 1,
		 	'quantity' => 40,
		 	'measurement_unit_id' => 4
	 	));


	 	MenuItem::create(array(
		 	'ingredient_id' => 3, 
		 	'menu_id' => 1,
		 	'quantity' => 200,
		 	'measurement_unit_id' => 4
	 	));

	 	MenuItem::create(array(
		 	'ingredient_id' => 4, 
		 	'menu_id' => 1,
		 	'quantity' => 50,
		 	'measurement_unit_id' => 4
	 	));

	 	MenuItem::create(array(
		 	'ingredient_id' => 5, 
		 	'menu_id' => 1,
		 	'quantity' => 3,
		 	'measurement_unit_id' => 4
	 	));

	 	MenuItem::create(array(
		 	'ingredient_id' => 3, 
		 	'menu_id' => 2,
		 	'quantity' => 300,
		 	'measurement_unit_id' => 4
	 	));

	 	MenuItem::create(array(
		 	'ingredient_id' => 2, 
		 	'menu_id' => 3,
		 	'quantity' => 100,
		 	'measurement_unit_id' => 4
	 	));

	 	MenuItem::create(array(
		 	'ingredient_id' => 5, 
		 	'menu_id' => 3,
		 	'quantity' => 10,
		 	'measurement_unit_id' => 4
	 	));
	}
}