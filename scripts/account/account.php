<?php

//temporarily commented out for include errors
// include_once('../Transaction/transaction.php');

class Account
{
	private	$accountName;
	private $transacationHistory;
	private $accountBalance;
	private $accountType;

	function __construct ($name)
	{
		$this->accountName = $name;
		$this->transacationHistory = array();
	}

	private function setName($name)
	{
		$this->accountName = $name;
	}

	 private function setHistory($transactions)
	 {
	 	$this->transacationHistory = $transacations;
	 }

	private function setType($type)
	{
		$this->accountType = $type;
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
		$accountBalance = 0;
		for($i = 0; $i < count($this->transacationHistory); $i++)
		{
			$accountBalance += $this->transacationHistory[$i]->getAmount();
		}
		return $accountBalance;
	}

	private function getType()
	{
		return $this->accountType;
	}

	public function getLastTransaction()
	{
		return $this->transacationHistory(count($this->transacationHistory)-1);
	}

	public function addTransaction($newTransaction)
	{
		array_push($this->transacationHistory, $newTransaction);
	}
}
?>
