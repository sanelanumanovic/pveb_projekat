<?php

class MenuTableSeeder extends Seeder {

	public function run() {
		DB::table('menu')->delete();
		
		Menu::create(array(
		 	'name' => 'Krompir paprikas', 
		 	'price' => '500',
		 	'for_two' => false,
		 	'active' => true,
		 	'description' => ''
	 	));

	    Menu::create(array(
		 	'name' => 'Piletina sa rostilja', 
		 	'price' => '650',
		 	'for_two' => false,
		 	'active' => true,
		 	'description' => ''
	 	));


	 	Menu::create(array(
		 	'name' => 'Pohovani kolutici luka', 
		 	'price' => '150',
		 	'for_two' => false,
		 	'active' => true,
		 	'description' => ''
	 	));

	}
}