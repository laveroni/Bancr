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
		$posAccount = new Account("Assets", $this->numAccounts);
		$this->addAccount($posAccount);

		$negAccount = new Account("Liabilities", $this->numAccounts);
		$this->addAccount($negAccount);

		$netAccount = new Account("Net Worth", $this->numAccounts);
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

		$transArray = $this->accounts[$accountObject->getNumber()]->getHistory();

		foreach($transArray as $trans)
		{
			if($trans->getAmount() >= 0)
			{
				$this->accounts[0]->changeBalance(-$trans->getAmount());
				$this->accounts[2]->changeBalance(-$trans->getAmount());
			}
			else if ($trans->getAmount() < 0)
			{
				$this->accounts[1]->changeBalance(-$trans->getAmount());
				$this->accounts[2]->changeBalance(-$trans->getAmount());
			}
		}


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

	public function addTransaction($account, $date, $amount, $merchant)
	{

		$newTransaction = new Transaction($account, $date, $amount, $merchant);
		//locate which account object by finding the key that is the account number
		//assuming that the key exists

		//find account
		$transAccounts = $this->getAccountsArray();
		$arrayKey = -1;
		foreach ($transAccounts as $key => $value)
		{ 
			if($value->getName() == $account)
			{
				$arrayKey = $key;
			}
				
		}

		//if arrayKey == -1, then account doesnt exist, add it
		if($arrayKey == -1)
		{
			$arrayKey = $this->getNumAccounts();
			$newAccount = new Account($account, $arrayKey);
			$this->addAccount($newAccount);
		}


		if (array_key_exists($arrayKey, $this->accounts)) 
		{
    		$this->accounts[$arrayKey]->addTransaction($newTransaction);

    		//add to net
    		$this->accounts[2]->changeBalance($amount);

    		//add to credit
    		if($amount < 0)
    		{
    			$this->accounts[1]->changeBalance($amount);
    		}
    		//add to savings
    		if($amount >= 0)
    		{
    			$this->accounts[0]->changeBalance($amount);
    		}
		}
		else
		{
			echo "Account number: " . $arrayKey . " is invalid in user addTransaction";
			exit();
		}

	}
}

?>