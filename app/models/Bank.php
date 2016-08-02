<?php


class Bank extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_banks';

	protected $fillable = ['beneficiary_name','name','swift_code','iban'];

	public function rules(){
		if(!$this->id){
			$this->id = 0;
		}
		return [
			'name' => 'required',
			'beneficiary_name' => 'required',
			'swift_code' => 'required',
			'iban' => 'required|unique:user_banks,iban,'.$this->id
		];
	}

	public function isValid($data){
		$validator = Validator::make($data,$this->rules());
		if( $validator->fails() ){
			throw new Exception( AppHelpers::errorSummary( $validator->messages() ) );
		}

		return true;
	}

	public function canMakeDeposit($value){
		if($this->bank_balance < $value)
			throw new Exception('User Balance in Bank '.$this->name.' is less than '.$value);			
	}

}
