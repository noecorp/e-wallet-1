<?php

class TransactionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id = null)
	{
		if(is_null($id)){
			$user = Auth::user();
		}else{
			$user = User::find($id);
		}

		if(!$user){
			App::abort(404);
		}
		
		$models = $user->operations()->where(function($query)
            {
                $query->where('type', '=', Operation::TYPE_TRANSACTION_IN)
                      ->orWhere('type', '=', Operation::TYPE_TRANSACTION_OUT);
            })->orderBy('created_at','desc')->paginate(20);

		// $queries = DB::getQueryLog();
		// $last_query = end($queries);

		// var_dump($last_query);
		// exit();

		return View::make('profile.transaction.all',[
			'user' => $user,
			'models' => $models,
			'title' => 'All Transactions',
			]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = Auth::user();
		if(!$user){
			App::abort(404);
		}

		return View::make('profile.transaction.new',[
			'title'=>'New Deposit',
			'user'=>$user,
		]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		#when making transaction we need to make two transactions
		#one for the user as who made the transaction as Transaction Out and decrease his balance
		#and the other one for the target user and increase his  
		$user = Auth::user();
		$targetUser = User::findUserByEmail(Input::get('email'));

		if(!$user || !$targetUser){
			App::abort(404);
		}

		DB::beginTransaction();
		try{
			$model = new Operation();
			$model->scenario = 'transaction';
			$model->isValid(Input::all());
			
			$value = Input::get('value');

			$user->canMakeWithdrawal($value);
			$model->createNew($value, Operation::TYPE_TRANSACTION_OUT);

			$modelTargetUser = new Transaction();
			$modelTargetUser->operation_id = $model->id;
			$modelTargetUser->user_id = $targetUser->id;
			if(!$modelTargetUser->save()){
				throw new Exception("Error Saving Transaction");
			}

			$model = new Operation();
			$model->createNew($value, Operation::TYPE_TRANSACTION_IN,$targetUser);

			$modelTargetUser = new Transaction();
			$modelTargetUser->operation_id = $model->id;
			$modelTargetUser->user_id = $user->id;
			if(!$modelTargetUser->save()){
				throw new Exception("Error Saving Transaction");
			}

			DB::commit();
			Flash::set('Saved Successfully','success');
			return Redirect::to(url('transactions'));
		}catch(Exception $e){
			DB::rollback();
			Flash::set($e->getMessage(),'danger');
			return Redirect::back()->withInput();
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
