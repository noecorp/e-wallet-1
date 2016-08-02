<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		#used to save the related bank of deposits and withdrawals operations
		
		Schema::create('bank_operation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('operation_id')->index();
			#deposite had been made from a bank
			$table->integer('bank_id')->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bank_operation');
	}

}
