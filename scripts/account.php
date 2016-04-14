<?php

//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
//REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

require_once('transaction.php');

class Account
{
	private	$accountName;
	private $accountType;
	private $transacationHistory;

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