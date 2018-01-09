<?php

class OnlineDeliveryTableSeeder extends Seeder {

	public function run() {
		DB::table('online_deliveries')->delete();
		
		OnlineDelivery::create(array(
		 	'order_id' => 1, 
		 	'supplier_id' => 1, 
		 	'address' => 'Adresa 1',
		 	'contact' => '-'
	 	));

	 
		OnlineDelivery::create(array(
		 	'order_id' => 3, 
		 	'supplier_id' => 1, 
		 	'address' => 'Adresa 1',
		 	'contact' => '011123654'
	 	));

	 	OnlineDelivery::create(array(
		 	'order_id' => 7, 
		 	'supplier_id' => 1, 
		 	'address' => 'Adresa 1',
		 	'contact' => '011123654'
	 	));
	}
}