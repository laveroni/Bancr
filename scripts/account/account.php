<?php
require_once('../Transaction/transaction.php');
class Account
{
	private $acountNumber;
	private	$accountName;
	private $transacationHistory = array();
	private $accountBalance;

	function __construct ($name, $balance, $transactions){
		$this->$accountName = $name;
		$this->$transacationHistory = $transacations;
		$this->$accountBalance = $balance;
	}

	private function setNumber($number){
		$this->$accountNumber = $number;
	}

	private function setName($name){
		$this->$accountName = $name;
	}

	 private function setHistory($transactions){
	 	$this->$transacationHistory = $transacations;
	 }

	private function setBalance($balance){
		$this->setBalance = $balance;
	}

	private function getNumber(){
		return $this->$accountNumber;
	}

	public function getName(){
		return $this->$accountName;
	}

	 public function getHistory(){
	 	return $this->$transacationHistory;
	 }

	public function getBalance(){
		return $this->$accountBalance;
	}

	public function getLastTransaction(){
		return $this-> $transacationHistory(count($transacationHistory)-1);
	}

	public function addTransaction($newTransaction){
		array_push($transacationHistory, $newTransaction);
	}

}

?>
