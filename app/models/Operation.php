<?php


class Operation extends Eloquent {

	const TYPE_DEPOSIT = 0;
	const TYPE_WITHDRAWAL = 1;
	const TYPE_TRANSACTION_IN = 2;
	const TYPE_TRANSACTION_OUT = 3;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'operations';

	public $scenario = 'deposit';

	public function rules(){
		if($this->scenario == 'deposit'){
			return [
				'value' => 'required|min:1',
				'bank_id' => 'required|exists:user_banks,id|belongsToUser',
			];
		}elseif($this->scenario == 'transaction'){
			return [
				'value' => 'required|min:1',
				'email' => 'required|exists:users,email',
			];
		}
	}

	public function isValid($data){
		$validator = Validator::make($data,$this->rules());
		if( $validator->fails() ){
			throw new Exception( AppHelpers::errorSummary( $validator->messages() ) );
		}

		return true;
	}

	public function createNew($value,$type,$user = null){
		if(is_null($user)){
			$user = Auth::user();
		}

		$this->value = $value;
		$this->user_id = $user->id;
		$this->user_balance_before = $user->balance; 
		$this->type = $type;

		if( !$this->save() ){
			throw new Exception("Cannot Save Operation");
		}

		if( $type == self::TYPE_DEPOSIT || $type == self::TYPE_TRANSACTION_IN ){
			$user->balance += $value;
		}elseif( $type == self::TYPE_WITHDRAWAL || $type == self::TYPE_TRANSACTION_OUT ){
			$user->balance -= $value;
		}

		if(!$user->save()){
			throw new Exception("Cannot Save User New Blance");
		} 
	}

	public function operationBank(){
		return $this->hasOne(OperationBank::class);
	}

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function transactionModel(){
		return $this->hasOne(Transaction::class);
	}

	public function transactionTargetUser(){
		$model = $this->transactionModel;
		return $model->user;
	}
}
