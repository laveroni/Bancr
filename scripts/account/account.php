<?php

//temporarily commented out for include errors
// include_once('../Transaction/transaction.php');

class Account
{
	private $acountNumber;
	private	$accountName;
	private $transacationHistory;
	private $accountBalance;

	function __construct ($name)
	{
		//TODO:  GET ACCOUNT NUMBER FROM DATABASE
		$this->accountNumber = 0;

		
		$this->accountName = $name;
		$this->transacationHistory = array();
		$this->accountBalance = 0;
	}



	public function setNumber($number)
	{
		$this->accountNumber = $number;
	}

	// private function setName($name)
	// {
	// 	$this->accountName = $name;
	// }

	//  private function setHistory($transactions)
	//  {
	//  	$this->transacationHistory = $transacations;
	//  }

	// private function setBalance($balance)
	// {
	// 	$this->setBalance = $balance;
	// }

	public function getNumber()
	{
		return $this->accountNumber;
	}

	public function getName()
	{
		return $this->accountName;
	}

	public function getHistory()
	{
	 	return $this->transacationHistory;
	}

	public function getBalance()
	{
		return $this->accountBalance;
	}

	public function getLastTransaction()
	{
		$num = count($this->transacationHistory);
		return $this->transacationHistory[$num-1];
	}

	public function addTransaction($newTransaction)
	{
		array_push($this->transacationHistory, $newTransaction);
	}

}

?>
