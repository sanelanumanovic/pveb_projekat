<?php

class ProcurementTableSeeder extends Seeder {
	public function run() {
		DB::table('users')->delete();

		Procurement::create(array(


			)
		);

	}

}