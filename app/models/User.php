<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;


class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	protected $fillable = ['name','email','phone','password','image'];

	protected $dates = ['deleted_at'];

	public $scenario = 'insert';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	public function isSuperAdmin(){
		return $this->role == 1;
	}

	public function rules(){
		if(!$this->id){
			$this->id = 0;
		}

		$rules = [];

		if(in_array($this->scenario, array('insert','update','register') ) ){
			$rules = array_merge($rules,[
				'name' => 'required',
				'phone' => 'required|numeric|unique:users,phone,'.$this->id,
				'email' => 'required|email|unique:users,email,'.$this->id,
			]);
		}

		if(in_array($this->scenario, array('insert','update')) ){
			$rules = array_merge($rules ,[
				'image' => 'required',
			]);
		}

		if($this->scenario == 'insert' || $this->scenario == 'change-password'){
			$rules['password'] = 'required|confirmed';
		}

		if($this->scenario == 'change-password'){
			$rules['old_password'] = 'required';
		}

		return $rules;
	}

	public function isValid($data){
		$validator = Validator::make($data,$this->rules());
		if( $validator->fails() ){
			throw new Exception( AppHelpers::errorSummary( $validator->messages() ) );
		}

		return true;
	}

	public static function isLoginValid($data){
		$validator = Validator::make($data,[
			'email' => 'required|email',
			'password' => 'required'
		]);

		if( $validator->fails() ){
			throw new Exception(AppHelpers::errorSummary( $validator->messages() ) );
		}

		return true;
	}

	public static function createNew($data,$scenario = 'insert'){
		$model = new self($data);

		$model->scenario = $scenario;

		$model->isValid($data);

		$model->password = Hash::make($model->password);
		$model->role = 0;
		$model->account_id = AppHelpers::generateRandomString();

		$model->save();

		return true;
	}

	public function edit($data){
		$this->scenario = 'update';

		$this->isValid($data);

		$this->fill($data);

		$this->save();
	}

	public function featuredImage(){
        return $this->hasOne(FileModel::class,'id','image');
    }

    public function banks(){
    	return $this->hasMany(Bank::class);
    }

    public function operations(){
    	return $this->hasMany(Operation::class,'user_id','id');
    }

    /**
     * [Used to make instance from Authorization class and check of user can do it]
     * @param  [string] $privilige 
     * @return [boolean]            [description]
     */
    public function can($privilige,$user = null){
    	$auth = new Authorization($privilige,$user);

    	try{
    		return $auth->check();
    	}catch(Exception $e){
    		return false;
    	}
    }

    public function canMakeWithdrawal($value,$op = 'Withdrawal'){
    	if($value > $this->balance){
    		throw new Exception('Cannot Make '.$op.' more than '.$this->balance);
    	}
    }

    public static function findUserByEmail($email){
    	$model = User::where('email',$email)->first();
    	return $model;
    }
}
