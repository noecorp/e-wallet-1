<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('user.login', ['title' => 'Login']);	
	}

	public function signup()
	{
		// Flash::set("new message",'success');
		return View::make('user.signup', ['title' => 'Login']);	
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		try{
			User::createNew(Input::all(),'register');
		}catch(\Exception $e){
			Flash::set($e->getMessage() ,'danger');	
			return Redirect::to(url('/signup'));	
		}
		
		
		Flash::set("Registered Successfully",'success');	
		return Redirect::to(url('/login'));	
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function doLogin()
	{
		try {
			User::isLoginValid( Input::all() );
		} catch (\Exception $e) {
			Flash::set( $e->getMessage() ,'danger');		
			return Redirect::to(url('/login'));	
		}

		if (Auth::attempt( array('email' => Input::get('email'), 'password' => Input::get('password') ) ) )
		{
			if(Auth::user()->role == 1){
			    return Redirect::to(url('/admin'));	
			}
		    return Redirect::to(url('/'));	

		}

		Flash::set("Wrong Credentials",'danger');	
		return Redirect::to(url('/login'));	
	}

	public function destroy(){
		
		Auth::logout();

		return Redirect::to(url('/login'));	
	}


}
