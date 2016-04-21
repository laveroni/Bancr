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

		//NNED TO MAKE SURE THAT UNSETTING ACTUALLY UNSETS THE VARIABLES

		foreach($this->accounts[$accountObject->getNumber()]->transacationHistory as $trans)
		{
			if($trans->getAmount() >= 0)
			{
				$this->accounts[0]->changeBalance(-$trans->getAmount());
				$this->accounts[2]->changeBalance(-$trans->getAmount());

				//unset the transaction from the account 0,1,2 transaction array
				foreach($this->accounts[0]->transacationHistory as $i => $credit)
				{
					if($credit->getAccount() == $accountObject->getName())
					{
						unset($this->accounts[0]->transacationHistory[$i]);
					}
				}
				foreach($this->accounts[2]->transacationHistory as $i => $net)
				{
					if($net->getAccount() == $accountObject->getName() && $net->getAmount() >= 0)
					{
						unset($this->accounts[2]->transacationHistory[$i]);
					}
				}
			}
			else if ($trans->getAmount() < 0)
			{
				$this->accounts[1]->changeBalance(-$trans->getAmount());
				$this->accounts[2]->changeBalance(-$trans->getAmount());

				//unset the transaction from the account 0,1,2 transaction array
				foreach($this->accounts[1]->transacationHistory as $i => $loan)
				{
					if($loan->getAccount() == $accountObject->getName())
					{
						unset($this->accounts[1]->transacationHistory[$i]);
					}
				}
				foreach($this->accounts[2]->transacationHistory as $i => $net)
				{
					if($net->getAccount() == $accountObject->getName() && $net->getAmount() < 0)
					{
						unset($this->accounts[2]->transacationHistory[$i]);
					}
				}
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
    		//$this->accounts[2]->changeBalance($amount);
    		$this->accounts[2]->addTransaction($newTransaction);

    		//add to credit
    		if($amount < 0)
    		{
    			//$this->accounts[1]->changeBalance($amount);

    			//below line will affect removeAccount. Must ensure that we remove the transactions from 0,1,2 first
    			$this->accounts[1]->addTransaction($newTransaction);
    		}
    		//add to savings
    		if($amount >= 0)
    		{
    			//$this->accounts[0]->changeBalance($amount);

    			//below line will affect removeAccount. Must ensure that we remove the transactions from 0,1,2 first
    			$this->accounts[0]->addTransaction($newTransaction);
    		}
		}

	}
}

?>