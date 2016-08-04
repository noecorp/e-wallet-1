<?php

class ReportController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id = null)
	{
		$start_date = date('Y-m-01 00:00:00');
		$end_date = date('Y-m-t 23:59:59');

		if( isset($_GET['start_date']) ){
			$start_date = date('Y-m-d 00:00:00',strtotime($_GET['start_date']));
		}

		if( isset($_GET['end_date']) ){
			$end_date = date('Y-m-d 23:59:59',strtotime($_GET['end_date']));
		}

		if( is_null($id) ){
			$user = Auth::user();
		}else{
			$user = User::find($id);
		}
		if(!$user){
			App::abort(404);
		}

		$models = Operation::where('user_id',$user->id)->where('created_at','>=',$start_date)->where('created_at','<=',$end_date)->orderBy('created_at','desc')->get();
		return View::make('reports.user-report',[
			'user' => $user,
			'models' => $models,
			'Title' => 'User Report',
			'start_date' => $start_date,
			'end_date' => $end_date,
			]);
	}

	public function depositsReport(){
		return $this->getBankOperations(Operation::TYPE_DEPOSIT);
	}

	public function withdrawalReport(){
		return $this->getBankOperations(Operation::TYPE_WITHDRAWAL);
	}


	public function getBankOperations($type){
		$start_date = date('Y-m-01 00:00:00');
		$end_date = date('Y-m-t 23:59:59');
		$user = null;

		if( isset($_GET['start_date']) ){
			$start_date = date('Y-m-d 00:00:00',strtotime($_GET['start_date']));
		}

		if( isset($_GET['end_date']) ){
			$end_date = date('Y-m-d 23:59:59',strtotime($_GET['end_date']));
		}

		if(isset($_GET['user_id']) && $_GET['user_id']){
			$user = User::find($_GET['user_id']);
		}

		$models = OperationHelper::newInstance($type,$user)->setStartDate($start_date)->setEndDate($end_date)->getModels();

		// $queries = DB::getQueryLog();
		// $last_query = end($queries);

		// var_dump($last_query);
		// exit();
		// 
		$item = 'Deposit';
		if($type == Operation::TYPE_WITHDRAWAL){
			$item = 'Withdrawal';
		}

		return View::make('reports.bank-operations',[
			'models' => $models,
			'Title' => 'Deposit Report',
			'start_date' => $start_date,
			'end_date' => $end_date,
			'user' => $user,
			'item' => $item
			]);
	}

	public function transactionReport(){
		$start_date = date('Y-m-01 00:00:00');
		$end_date = date('Y-m-t 23:59:59');
		$user = null;

		if( isset($_GET['start_date']) ){
			$start_date = date('Y-m-d 00:00:00',strtotime($_GET['start_date']));
		}

		if( isset($_GET['end_date']) ){
			$end_date = date('Y-m-d 23:59:59',strtotime($_GET['end_date']));
		}

		if(isset($_GET['user_id']) && $_GET['user_id']){
			$user = User::find($_GET['user_id']);
		}

		$models = OperationHelper::newInstance(Operation::TYPE_TRANSACTION_OUT,$user)->setStartDate($start_date)->setEndDate($end_date)->getModels();		
		return View::make('reports.transactions',[
			'models' => $models,
			'Title' => 'Transaction Report',
			'start_date' => $start_date,
			'end_date' => $end_date,
			'user' => $user,
			]);
	}
}
