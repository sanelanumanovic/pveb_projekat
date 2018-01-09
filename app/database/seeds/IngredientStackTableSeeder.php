<?php

class IngredientStackTableSeeder extends Seeder {

	public function run() {
		DB::table('ingredient_stack')->delete();
		
		IngredientStack::create(array(
		 	'ingredient_id' => 1, 
		 	'quantity' => 5,
		 	'measurement_unit_id' => 2,
		 	'expiration_date' => '2018-04-25'
	 	));

	    IngredientStack::create(array(
		 	'ingredient_id' => 1, 
		 	'quantity' => 50,
		 	'measurement_unit_id' => true,
		 	'expiration_date' => '2018-06-25'
	 	));

	 	IngredientStack::create(array(
		 	'ingredient_id' => 2, 
		 	'quantity' => 3,
		 	'measurement_unit_id' => true,
		 	'expiration_date' => '2018-07-25'
	 	));

	 	IngredientStack::create(array(
		 	'ingredient_id' => 3, 
		 	'quantity' => 14,
		 	'measurement_unit_id' => true,
		 	'expiration_date' => '2018-01-25'
	 	));



	}
}