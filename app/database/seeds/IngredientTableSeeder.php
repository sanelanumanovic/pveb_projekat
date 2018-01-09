<?php

class IngredientTableSeeder extends Seeder {

	public function run() {
		DB::table('ingredients')->delete();
		
		Ingredient::create(array(
		 	'name' => 'Krompir', 
		 	'gluten' => false,
		 	'vegan' => true,
		 	'allergen' => false,
		 	'lenten' => true
	 	));

	 	Ingredient::create(array(
		 	'name' => 'Luk', 
		 	'gluten' => false,
		 	'vegan' => true,
		 	'allergen' => false,
		 	'lenten' => true
	 	));

	 	Ingredient::create(array(
		 	'name' => 'Piletina', 
		 	'gluten' => false,
		 	'vegan' => false,
		 	'allergen' => false,
		 	'lenten' => false
	 	));

	    Ingredient::create(array(
		 	'name' => 'Paprika', 
		 	'gluten' => false,
		 	'vegan' => true,
		 	'allergen' => false,
		 	'lenten' => true
	 	));

	 	Ingredient::create(array(
		 	'name' => 'So', 
		 	'gluten' => false,
		 	'vegan' => true,
		 	'allergen' => false,
		 	'lenten' => true
	 	));
	}
}