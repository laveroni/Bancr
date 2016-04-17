<?php

//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
//REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

require_once('transaction.php');

class Account
{
	private $acountNumber;
	private	$accountName;
	private $transacationHistory;
	private $accountBalance;

	function __construct ($name, $num)
	{
		$this->accountNumber = $num;
		
		$this->accountName = $name;
		$this->transacationHistory = array();
		$this->accountBalance = 0;
	}

	public function setNumber($number)
	{
		$this->accountNumber = $number;
	}
	
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
		// $accountBalance = 0;
		// for($i = 0; $i < count($this->transacationHistory); $i++)
		// {
		// 	$accountBalance += $this->transacationHistory[$i]->getAmount();
		// }
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

		$this->accountBalance += $newTransaction->getAmount();
	}

	public function changeBalance($addition)
	{
		$this->accountBalance += $addition;
	}
}

?>