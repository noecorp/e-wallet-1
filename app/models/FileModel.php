<?php


class FileModel extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'files';

	protected $fillable = ['beneficiary_name','new_name','user_id','extension'];

}
