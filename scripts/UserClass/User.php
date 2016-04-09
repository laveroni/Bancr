<?php

	//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    //REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

    //need to actually use it but right now it is not necessary and giving an include error
    //include_once('../account/account.php');

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

			//key is account number, value is the account object
			$this->accounts = array();
			$this->numAccounts = 0;
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

	}

?>