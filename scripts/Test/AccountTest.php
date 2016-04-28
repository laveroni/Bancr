<?php

include_once "/var/www/html/Bancr/scripts/account.php";
include_once "/var/www/html/Bancr/scripts/transaction.php";
//include_once "PHPUnit/Autoload.php";

class AccountTest extends PHPUnit_Framework_TestCase{

	protected $account;
	private $trans;

	protected function setUp(){
		$this->trans = array();
		$this->account = new Account("John", 3);
	}
	
	public function testSetNumber(){
		$this->account->setNumber(50);
		$this->assertEquals(50, $this->account->accountNumber);
	}
	
	public function testGetName(){
		$actual = $this->account->getName();
		$expected = "John";
		$this->assertEquals($expected, $actual);
	}
	
	public function testGetHistory(){
		$actual = $this->account->getHistory();
		$expected = $this->trans;
		$this->assertEquals($actual, $expected);
	}
	
	public function testGetBalance(){
		$expected = 0;
		$actual = $this->account->getBalance();
		$this->assertEquals($actual, $expected);
	}

	public function testGetLastTransaction(){
		$tran = new Transaction("savings", 2/31/23, 59, "tom", "Food");
		$this->account->addTransaction($tran);
		$tranHist = $this->account->getLastTransaction();
		$this->assertEquals($tran, $tranHist);
	}

	public function testAddTransaction(){
		$tranPrior = $this->account->getHistory();
		$prior = count($tranPrior);
		$tran = new Transaction("savings", 2/31/23, 59, "tom", "Food");
		$this->account->addTransaction($tran);
		$tranNow = $this->account->getHistory();
		$now = count($tranNow);
		$this->assertEquals($prior, $now - 1);
	}
}
?>
