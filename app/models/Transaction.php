<?php


class Transaction extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'transactions';

	public $timestamps = false;

	public function user(){
		return $this->belongsTo(User::class);
	}

}
