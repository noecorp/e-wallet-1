<?php

class BankController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id = null){
		$user = $this->getUser($id);
		if(!$user){
			App::abort(404);
		}

		return View::make('profile.banks.all',['user'=>$user,'title'=>'User Bank Account']);
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

		return View::make('profile.banks.new',['user'=>$user,'title'=>'User Bank Account']);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$model = new Bank($input = Input::all());
		$model->user_id = Auth::user()->id;
		$model->bank_balance = rand(1000,1000000);
		try {
			$model->isValid($input);	
		} catch (Exception $e) {
			Flash::set($e->getMessage(),'danger');
			return Redirect::back()->withInput();
		}

		$model->save();

		Flash::set('Saved Successfully','success');
		return Redirect::to(url('banks/'));
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
		$user = Auth::user();
		$model = Bank::find($id);
		if(!$model || !$user){
			App::abort(404);
		}

		return View::make('profile.banks.edit',[
			'title' => 'Edit Bank Account',
			'model' => $model,
			'user' => $user
		]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$model = Bank::find($id);

		//TODO : user can edit bank

		$model->user_id = Auth::user()->id;
		try {
			$model->isValid($input = Input::all());	
		} catch (Exception $e) {
			Flash::set($e->getMessage(),'danger');
			return Redirect::back()->withInput();
		}
		$model->fill($input);
		$model->save();

		Flash::set('Saved Successfully','success');
		return Redirect::to(url('banks/'));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		$model = Bank::find(Input::get('deletedId'));
		if(!$model){
			App::abort(404);
		}

		$model->delete();

		Flash::set('Deleted Successfully','success');
		return Redirect::to(url('banks/'));
	}

	public function getUser($id){
							# if not is admin then show the user his profile even if $id is set
		if(is_null($id) || ( !is_null($id) && Auth::user()->role == 0 ) ){
			$id = Auth::user()->id;
		}
		return User::find($id);
	}

}
