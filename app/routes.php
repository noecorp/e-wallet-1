<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/user/{id}', 'HomeController@index');

Route::group(array('before'=>'guest'), function(){
	Route::get('/login','UserController@index');
	Route::get('/signup','UserController@signup');
	Route::post('/login','UserController@doLogin');
	Route::post('/signup','UserController@create');
});

Route::get('/files','ImageController@getImages');
Route::post('/files/new','ImageController@newImage');

Route::group(array('before'=>'auth'), function(){
	Route::get('/settings', 'HomeController@settings');

	Route::put('/update-settings', 'UsersController@update');
	Route::put('/update-password', 'UsersController@passwordUpdate');
	
	Route::get('/banks', 'BankController@index');
	Route::get('/banks/new', 'BankController@create');
	Route::post('/banks/new', 'BankController@store');
	Route::get('/bank/{id}/edit', 'BankController@edit');
	Route::put('/bank/{id}/edit', 'BankController@update');
	Route::delete('/banks/delete', 'BankController@destroy');


	Route::get('/deposits','BankOperationController@index');
	Route::get('/deposits/new','BankOperationController@create');
	Route::post('/deposits/new','BankOperationController@store');

	Route::get('/withdrawals','BankOperationController@indexWithdrawal');
	Route::get('/withdrawals/new','BankOperationController@createWithdrawal');
	Route::post('/withdrawals/new','BankOperationController@storeWithdrawal');

	Route::get('/transactions','TransactionController@index');
	Route::get('transactions/new','TransactionController@create');
	Route::post('transactions/new','TransactionController@store');

	Route::get('/logout','UserController@destroy');
});

Route::group(array('before'=>'auth|admin'), function(){
	Route::get('/user/{id}/settings', 'HomeController@settings');
	Route::get('/user/{id}/banks', 'BankController@index');
	Route::get('user/{id}/deposits','BankOperationController@index');
	Route::get('user/{id}/withdrawals','BankOperationController@indexWithdrawal');
	Route::get('user/{id}/transactions','TransactionController@index');
});


Route::group(array('prefix' => 'admin','before'=>'auth|admin'), function()
{
	Route::get('/','DashboardController@index');
	
	Route::get('/users','UsersController@index');
	Route::get('/users/new','UsersController@create');
	Route::post('/users/new','UsersController@store');
	Route::get('/users/{id}/edit','UsersController@edit');
	Route::put('/users/{id}/edit','UsersController@update');
	Route::delete('/users/delete','UsersController@destroy');
	Route::get('/users/{id}/change-password','UsersController@passwordEdit');
	Route::put('/users/{id}/change-password','UsersController@passwordUpdate');

	Route::get('reports/user/{id}','ReportController@index');
	Route::get('reports/deposits','ReportController@depositsReport');
	Route::get('reports/withdrawals','ReportController@withdrawalReport');
	Route::get('reports/transactions','ReportController@transactionReport');
});


App::missing(function($exception)
{
    return Response::view('404', array(), 404);
});