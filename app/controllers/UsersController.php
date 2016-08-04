<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$models = User::where('role',0)->orderBy('created_at','desc')->get();

		//TODO : add soft delete to users
		return View::make('users.all',['models'=>$models]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.new',['title'=>'New User']);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try{
			User::createNew(Input::all());
		}catch(\Exception $e){
			Flash::set($e->getMessage() ,'danger');	
			return Redirect::back()->withInput();	
		}
		
		
		Flash::set("Saved Successfully",'success');	
		return Redirect::to(url('/admin/users'));	
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
		$model = User::find($id);
		if(!$model){
			Flash::set("Cannot Find User",'danger');	
			return Redirect::back();		
		}

		return View::make('users.edit',['model'=>$model,'title' => 'Edit User']);

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id = null)
	{
		if(is_null($id)){
			$id = Auth::user()->id;
		}

		$model = User::find($id);
		if(!$model){
			Flash::set("Cannot Find User",'danger');	
			return Redirect::back();		
		}

		try {
			$model->edit(Input::all());
		} catch (Exception $e) {
			Flash::set($e->getMessage(),'danger');	
			return Redirect::back();	
		}

		Flash::set("Saved Successfully",'success');
		if(Auth::user()->isSuperAdmin()){
			return Redirect::to(url('/admin/users'));		
		}else{
			return Redirect::back();		
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		$model = User::find(Input::get('deletedId'));

		if(!$model){
			Flash::set("Cannot Find User",'danger');
		}else{
			$model->delete();
		}

		return Redirect::back();
	}

	public function passwordEdit($id){
		$model = User::find($id);
		if(!$model){
			Flash::set("Cannot Find User",'danger');	
			return Redirect::back();		
		}

		return View::make('users.change-password',['title'=>'Change User Password','model'=>$model]);
	}

	public function passwordUpdate($id = null){
		
		if(is_null($id)){
			$id = Auth::user()->id;
		}

		$model = User::find($id);
		if(!$model){
			Flash::set("Cannot Find User",'danger');	
			return Redirect::back();		
		}

		try {
			$model->scenario = 'change-password';
			$model->isValid(Input::all());
		} catch (Exception $e) {
			Flash::set($e->getMessage(),'danger');	
			return Redirect::back();
		}
		
		if (! Hash::check( Input::get('old_password'), $model->password) )
		{
		 	Flash::set('Current Password Didn\'t mactch','danger');	
			return Redirect::back();   
		}

		$model->password = Hash::make(Input::get('password'));
		$model->save();

		Flash::set("Saved Successfully",'success');	
		if(Auth::user()->isSuperAdmin()){
			return Redirect::to(url('/admin/users'));		
		}else{
			return Redirect::back();		
		}
	}


}
