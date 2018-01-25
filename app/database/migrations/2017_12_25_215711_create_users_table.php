<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function(Blueprint $table) {
			
			$table->increments('id');
			$table->string('first_name', 32);
			$table->string('last_name', 32);
			$table->string('username', 32);
			$table->string('password', 64);
			$table->string('email', 64);
			$table->string('account', 32);
			$table->string('address', 64);
			$table->unsignedInteger('supervisor_id')->nullable();
			$table->foreign('supervisor_id')->references('id')->on('users');
			$table->string('phone', 12);
			$table->timestamp('start_date');
			$table->boolean('admin')->default(0);
			$table->string('personal_number', 13);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}

}
