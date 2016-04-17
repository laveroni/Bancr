<?php

//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
//REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

require_once('account.php');
require_once('transaction.php');

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

	public function addTransaction($account, $date, $amount, $merchant, $accountNumber)
	{
		// // Check whether account exists or not
		// if(!array_key_exists($account, $this->accounts)) 
		// {	
		// 	// Create account and add transaction
		// 	$new_account = new Account($account);
		// 	$this->addAccount($new_account);
		// }
		// // Create new transaction object
		// $new_transaction = new Transaction($account, $date, $amount, $merchant);
		// // Add transaction to account
		// $this->accounts[$account]->addTransaction($new_transaction);


		$newTransaction = new Transaction($account, $date, $amount, $merchant);
		//locate which account object by finding the key that is the account number
		//assuming that the key exists
		if (array_key_exists($accountNumber, $this->accounts)) 
		{
    		$this->accounts[$accountNumber]->addTransaction($newTransaction);

    		//add to net
    		$this->accounts[2]->changeBalance($amount);
		}
		else
		{
			echo "Account number: " . $accountNumber . " is invalid in user addTransaction";
			exit();
		}

	}
}

?>