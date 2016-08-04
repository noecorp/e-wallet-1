<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBanksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_banks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->index();
			$table->string('beneficiary_name')->index();
			$table->string('name');
			$table->string('swift_code');
			$table->string('iban');

			#asumming that user has balance in his bank
			#thus useful for validation when making a depsit from bank to wallet
			$table->string('bank_balance');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_banks');
	}

}
