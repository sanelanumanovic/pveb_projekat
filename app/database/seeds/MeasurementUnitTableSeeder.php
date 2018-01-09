<?php

class MeasurementUnitTableSeeder extends Seeder {

	public function run() {
		DB::table('measurement_units')->delete();
		
		MeasurementUnit::create(array(
		 	'name' => 'komad', 
		 	'short_name' => 'kom'
	 	));

	    MeasurementUnit::create(array(
		 	'name' => 'kg', 
		 	'short_name' => 'kg'
	 	));

	 	MeasurementUnit::create(array(
		 	'name' => 'Litar', 
		 	'short_name' => 'l'
	 	));
	 	
	 	MeasurementUnit::create(array(
		 	'name' => 'g', 
		 	'short_name' => 'g'
	 	));

	 	MeasurementUnit::create(array(
		 	'name' => 'ml', 
		 	'short_name' => 'ml'
	 	));



	}
}