<?php
class Account
{
	private	 $accountName;
	//private $accountType;
	private $accountBalance;

	function __construct ($name, $balance){
		$this -> $accountName = $name;
	//	$this -> $accountType = $type;
		$this -> $accountBalance = $balance;
	}

	private function setName($name){
		$this->$accountName = $name;
	}

	// private function setType($type){
	// 	$this->accountType = $type;
	// }

	private function setBalance($balance){
		$this->setBalance = $balance;
	}

	public function getName(){
		return $this->$accountName;
	}

	// public function getType(){
	// 	return this->$accountType;
	// }

	public function getBalance(){
		return $this->$accountBalance;
	}

}

?>