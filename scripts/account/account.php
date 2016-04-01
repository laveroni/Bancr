<?php

	//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    //REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

	class Account
	{
		private	$accountName;
		private $accountType;
		private $accountBalance;
		private $transactions;

		function __construct ($name, $type, $balance)
		{
			$this->$accountName = $name;
			$this->$accountType = $type;
			$this->$accountBalance = $balance;
			$this->transactions = array();
		}

		private function setName($name)
		{
			$this->$accountName = $name;
		}

		private function setType($type)
		{
			$this->accountType = $type;
		}

		private function setBalance($balance)
		{
			$this->setBalance = $balance;
		}

		public function getName()
		{
			return $this->$accountName;
		}

		public function getType()
		{
			return $this->$accountType;
		}

		public function getBalance()
		{
			return $this->$accountBalance;
		}

	}

?>