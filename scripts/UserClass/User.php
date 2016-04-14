<?php

	//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    //REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

    //need to actually use it but right now it is not necessary and giving an include error
    include "/var/www/html/Bancr/scripts/account/account.php";
    include_once "/var/www/html/Bancr/scripts/Transaction/transaction.php";

	class User
	{

		private $email;
		private $encryptedPassword;
		private $accounts;
		private $numAccounts;

		function __construct($email,$encryptedPassword) 
		{
			$this->email = $email;
			$this->encryptedPassword = $encryptedPassword;

			$this->accounts = array();

			//key is account number, value is the account object
			$this->numAccounts = 0;

			$posAccount = new Account("Savings", $this->numAccounts);
			$this->addAccount($posAccount);

			$negAccount = new Account("Credit", $this->numAccounts);
			$this->addAccount($negAccount);

			$netAccount = new Account("Net", $this->numAccounts);
			$this->addAccount($netAccount);
		}

		private function setEncryptedPassword($password)
		{
			$this->encryptedPassword = $password;
		}

		private function getEncryptedPassword()
		{
			return $this->encryptedPassword;
		}

		public function getEmail()
		{
			return $this->email;
		}

		private function addTransaction($date, $amount, $type, $merchant, $accountNumber)
		{
			$newTransaction = new Transaction($date, $amount, $type, $merchant);

			//locate which account object by finding the key that is the account number
			//assuming that the key exists
			if (array_key_exists($accountNumber, $this->accounts)) 
			{
    			$this->accounts[$accountNumber]->addTransaction($newTransaction);
			}
			else
			{
				echo "Account number: " . $accountNumber . " is invalid in user addTransaction";
			}

		}

		public function addAccount($accountObject)
		{
			$accountObject->setNumber($this->numAccounts);
			$this->numAccounts++;

			$this->accounts[$accountObject->getNumber()] = $accountObject;
		}

		public function removeAccount($accountObject)
		{
			unset($this->accounts[$accountObject->getNumber()]);
		}

		public function getAccountsArray()
		{
			return $this->accounts;
		}

		public function getNumAccounts()
		{
			return $this->numAccounts;
		}

	}

?>