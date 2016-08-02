<?php

class OperationHelper{
	public $type = null;
	public $user = null;

	public $models;

	public $start_date;
	public $end_date;

	public function __construct($type = null , $user = null){
		if( !is_null($type) ){
			$this->type = $type;
		}

		if( !is_null($user) ){
			$this->user = $user;
		}

		$this->start_date = date('Y-m-01');
		$this->end_date = date('Y-m-t');

		return $this;
	}

	 /**
     * Sets the value of type.
     *
     * @param string $type Operation::TYPE_DEPOST|TYPE_WITHDRAWAL|TYPE_TRANSACTION_IN|TYPE_TRANSACTION_OUT
     *
     * @return self
     */
	public function setType($type){
		$this->type = $type;

		return $this;
	}

	/**
     * Sets the value of user.
     *
     * @param User $user 
     *
     * @return self
     */
	public function setUser($user){
		$this->user = $user;

		return $this;
	}

	/**
     * Sets the value of start_date.
     *
     * @param string $start_date the start date
     *
     * @return self
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    /**
     * Sets the value of start_date.
     *
     * @param string $start_date the start date
     *
     * @return self
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * Gets the value of start_date.
     *
     * @return string
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Gets the value of end_date.
     *
     * @return string
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * for Generlizing More ex: getting the sum of a value of just getting all models
     * @return QueryBuilder
     */
    public function getQuery(){
        $query = Operation::orderBy('created_at','desc')->where('created_at','>=',$this->start_date)->where('created_at','<=',$this->end_date);
        if(!is_null($this->type)){
            $query->where('type',$this->type);
        }

        if($this->user){
            $query->where('user_id',$this->user->id);
        }

        return $query;
    }

    /**
     * get Results
     * @return Operation
     */
    public function getModels(){
		return  $this->getQuery()->paginate(30); 
	}

    public function getSum(){
        return $this->getQuery()->sum('value');
    }

	public static function newInstance($type = null,$user = null){
		$model = new self($type,$user);
		return $model;
	}
}