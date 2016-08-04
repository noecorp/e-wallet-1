<?php

class Flash{
	protected $types = ['info','warning','success','danger'];
	
	protected $type;
	protected $message;
	private $hasFlash = false;
	
	public function __construct($message , $type = 'info'){
		$this->message = $message;
		$this->type = $type;
		$this->createNew();
	}

	public function setType($type){
		$this->type = $type;
	}

	public function setMessage($message){
		$this->message = $message;
	}

	public function createNew(){
		if(!in_array($this->type, $this->types)){
			$this->type = 'info';
		}
		if(!empty($this->message)){
			Session::flash('flash-'.$this->type,$this->message);
		}
	}

	public static function set($message , $type = 'info'){
		$instance = new self($message,$type);
	}

	public static function get(){
		
		$instance = new self('');
		
		$htmlString = '';
		foreach($instance->types as $type){
			if(Session::has('flash-'.$type)){
				
				$instance->hasFlash = true;
				$htmlString .= $instance->alertWrapper($type,Session::get('flash-'.$type));
			}			
		}
		if($instance->hasFlash){
			return $htmlString;
		}
	}
	public function alertWrapper($type,$message){
		return '<div class="alert alert-'.$type.'">'.$message.'</div>';
	}
}