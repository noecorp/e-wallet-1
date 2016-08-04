<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index($id = null)
	{
		
		if(Auth::check()){
			$user = $this->getUser($id);
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


			$models = $user->operations()->where('user_id',$user->id)->where('created_at','>=',$start_date)->where('created_at','<=',$end_date)->orderBy('created_at','desc')->paginate(20);
			
			return View::make('profile.index',[
				'title' => "Dashbaord",
				'user'=>$user,
				'models' => $models,
				'start_date' => $start_date,
				'end_date' => $end_date,
			]);
		}

		return View::make('home',['title'=>'Home Page']);
	}

	public function settings($id = null){
		$user = $this->getUser($id);
		return View::make('profile.account-settings',['title' => 'Account Settings','user'=>$user]);
	}

	public function getUser($id){
							# if not is admin then show the user his profile even if $id is set
		if(is_null($id) || ( !is_null($id) && Auth::user()->role == 0 ) ){
			$id = Auth::user()->id;
		}
		return User::find($id);
	}

}
