<?php

	//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    //REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

	require_once('../account/account.php');
    require_once('../Transaction/transaction.php');

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

		public function addAccount($accountObject)
		{
			$this->numAccounts++;
			$this->accounts[$accountObject->getName()] = $accountObject;
		}

		public function removeAccount($accountObject)
		{
			unset($accounts[$accountObject->getName()]);
		}

		public function getAccountsArray()
		{
			return $this->accounts;
		}

		public function addTransaction($account, $date, $amount, $merchant)
		{
			// Check whether account exists or not
			if(!array_key_exists($account, $this->accounts)) 
			{	
				// Create account and add transaction
				$new_account = new Account($account);
				$this->addAccount($new_account);
			}
			// Create new transaction object
			$new_transaction = new Transaction($account, $date, $amount, $merchant);
			// Add transaction to account
			$this->accounts[$account]->addTransaction($new_transaction);
		}
	}
?>