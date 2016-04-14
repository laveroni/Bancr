<?php

require_once('../Transaction/transaction.php');

class Account
{
	private	$accountName;
	private $transacationHistory;
	private $accountBalance;

	function __construct ($name)
	{
		$this->accountNumber = 0;
		$this->accountName = $name;
		$this->transacationHistory = array();
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
		$num = count($this->transacationHistory);
		return $this->transacationHistory[$num-1];
	}

	public function addTransaction($newTransaction)
	{
		array_push($this->transacationHistory, $newTransaction);
	}
}
?>