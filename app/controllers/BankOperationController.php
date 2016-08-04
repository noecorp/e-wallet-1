<?php

class BankOperationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id = null)
	{
		return $this->getOperations(Operation::TYPE_DEPOSIT,$id);
	}

	public function indexWithdrawal($id = null)
	{
		return $this->getOperations(Operation::TYPE_WITHDRAWAL,$id);
	}

	public function getOperations($type,$id){
		if(is_null($id)){
			$user = Auth::user();
		}else{
			$user = User::find($id);
		}

		if(!$user){
			App::abort(404);
		}

		$start_date = date('Y-m-01 00:00:00');
		$end_date = date('Y-m-t 23:59:59');

		if(isset( $_GET['start_date']) && $_GET['start_date'] ){
			$start_date = date('Y-m-d 00:00:00',strtotime( $_GET['start_date'] ) );
		}

		if( isset( $_GET['end_date']) && $_GET['end_date'] ){
			$end_date = date('Y-m-d 23:59:59',strtotime( $_GET['end_date'] ) );
		}


		
		$models = $user->operations()->with('operationBank')->where('type',$type)->where('created_at','>=',$start_date)->where('created_at','<=',$end_date)->orderBy('created_at','desc')->paginate(20);

		if($type == Operation::TYPE_WITHDRAWAL){
			$title = 'All Withdrawals';
			$type = 'withdrawals';
		}else{
			$title = 'All Deposits';
			$type = 'deposit';
		}

		return View::make('profile.operations.all',[
			'user'=>$user,
			'models' => $models,
			'title' => $title,
			'type' => $type,
			'start_date' => $start_date,
			'end_date' => $end_date,
		]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->getCreatePage('deposite');
	}

	public function createWithdrawal()
	{
		return $this->getCreatePage('withdrawal');
	}

	public function getCreatePage($type){
		$user = Auth::user();
		if(!$user){
			App::abort(404);
		}

		return View::make('profile.operations.new',[
			'title'=>'New Deposit',
			'user'=>$user,
			'type'=>$type
		]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return $this->createOperation(Operation::TYPE_DEPOSIT);
	}

	public function storeWithdrawal()
	{
		return $this->createOperation(Operation::TYPE_WITHDRAWAL);
	}

	public function createOperation($type){
		$user = Auth::user();
		$bank = Bank::find(Input::get('bank_id'));
		if(!$user){
			App::abort(404);
		}


		DB::beginTransaction();
		try {
			$model = new Operation();
			$model->isValid(Input::all());
			

			$value = Input::get('value');

			if($type == Operation::TYPE_DEPOSIT){
				#check if we can make a deposit from choosen bank
				$bank->canMakeDeposit($value);
				$bank->bank_balance -= $value;
			}else{
				#check if we can make a deposit from choosen bank
				$user->canMakeWithdrawal($value);
				$bank->bank_balance += $value;
			}
			
			#make new Operation and save user new balance 
			$model->createNew( $value, $type );

			$modelInfo = new OperationBank();
			$modelInfo->operation_id = $model->id;
			$modelInfo->bank_id = Input::get('bank_id');
			if(!$modelInfo->save()){
				throw new Exception('Cannot Save Model Info');
			}

			
			if(!$bank->save()){
				throw new Exception('Cannot Save New Bank Balance');
			}

			DB::commit();
			Flash::set("Saved Successfully");
			if($type == Operation::TYPE_DEPOSIT){
				return Redirect::to(url('/deposits'));
			}else{
				return Redirect::to(url('/withdrawals'));
			}
		} catch (Exception $e) {
			DB::rollback();
			Flash::set($e->getMessage(),'danger');
			return Redirect::back()->withInput();
		}
	}

}
