<?php

include_once "../account/account.php";
include_once "../Transaction/transaction.php";
//include_once "PHPUnit/Autoload.php";



class AccountTest extends PHPUnit_Framework_TestCase{


	protected $account;
	private $trans;

	protected function setUp(){
		$this->trans = new array();
		$this->account = new Account("Savings","5000",$this->trans);
	}

	protected function tearDown(){
		unset($this->account);
	}

	public function testSetNumber(){
		$this->account->setNumber(50);
		$this->assertEquals(50, $this->account->$accountNumber);
	}

	public function testSetName(){
		$this->account->setName("Test");
		$this->assertEquals("Test", $this->account->$accountName);
	}

	public function testSetHistory(){
		array_push($trans, "hello");
		$this->account->setHistory($this->trans);
		$this->assertEquals(1, $this->account->count($transactionHistory));
	}

	public function testSetBalance(){
		$this->account->setBalance(110);
		$this->assertEquals(110, $this->account->$accountBalance);
	}

	public function testGetNumber(){
		$this->method('getNumber')->willReturn(56);
		$this->assertEquals(56, $this->user->getNumber());
	}

	public function testGetName(){
		$actual = $this->account->getName();
		$expected = "Savings";
		$this->assertEquals($expected, $actual);
	}

	public function testGetHistory(){
		$this->arr = new array();
		$this->method('getHistory')->willReturn($this->arr);
		$this->assertEquals($this->arr, $this->user->getHistory());
	}

	public function testGetBalance(){
		$this->method('getBalance')->willReturn(56);
		$this->assertEquals(56, $this->user->getBalance());
	}

	public function testGetLastTransaction(){
		$tran = new Transaction("savings", 2/31/23, 59, "tom");
		$this->account->addTransaction($tran);
		$this->assertEquals($tran, $this->account->getLastTransaction());
	}

	public function testAddTransaction(){
		$prior = $this->account->count($transactionHistory);
		$tran = new Transaction("savings", 2/31/23, 59, "tom");
		$this->account->addTransaction($tran);
		$now = $this->account->count($transactionHistory);
		$this->assertEquals($prior, $now + 1);
	}
}
?>