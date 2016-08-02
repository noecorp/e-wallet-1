<?php


class OperationBank extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bank_operations';

	public $timestamps = false;

	public function bank(){
		return $this->belongsTo(Bank::class);
	}

}
