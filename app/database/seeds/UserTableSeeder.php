<?php

class UserTableSeeder extends Seeder {

	public function run() {
		DB::table('users')->delete();
		
		User::create(array(
		 	'first_name' => 'Zaposleni', 
		 	'last_name' => 'Prvi', 
		 	'phone' => '0611234567',
		 	'email' => 'zaposleni@gmail.com',
		 	'username' => 'zaposleni',
		 	'password' => Hash::make('zaposleni'),
		 	'personal_number' => '1122334455667',
		 	'admin' => 1



	 	));
	}
}