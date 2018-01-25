<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Eloquent::unguard();

		$this->call('UserTableSeeder');
        $this->call('SupplierTableSeeder');
        $this->call('ProcurementTableSeeder');
        $this->call('MeasurementUnitTableSeeder');
        $this->call('IngredientTableSeeder');
        $this->call('IngredientStackTableSeeder');
        $this->call('InventoryTableSeeder');
        $this->call('MenuTableSeeder');
        $this->call('MenuItemTableSeeder');
		$this->call('OrderTableSeeder');
		$this->call('OnlineDeliveryTableSeeder');
		$this->call('OrderProductTableSeeder');
		$this->call('SalaryTableSeeder');
		$this->call('ProcurementItemTableSeeder');
		$this->call('ProcurementInventoryItemTableSeeder');
	}

}
