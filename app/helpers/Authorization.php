<?php

class Authorization{

	private $user;

	#priviliges list
	public $list = [
		'create-new-bank-account',
		'update-settings',
		'create-deposit'
	];

	public $privilige;

	public function __construct($privilige ,$user){
		$this->user = $user;

		$this->privilige = $privilige;
	}


	public function check(){
		switch ($this->privilige) {
			case 'create-new-bank-account' || 'update-settings' || 'create-deposit':
				return $this->checkSameUser();
				break;
			
			default:
				return false;
				break;
		}
	}


	public function checkSameUser(){
		return Auth::user()->id == $this->user->id;
	}

}