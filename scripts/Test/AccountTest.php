<?php

include_once "../account/account.php";
include_once "../Transaction/transaction.php";
//include_once "PHPUnit/Autoload.php";

class AccountTest extends PHPUnit_Framework_TestCase{
	/**
	 * @runInSeparateProcess
	 */

	protected $account;
	private $trans;
	/**
	 * @runInSeparateProcess
	 */
	protected function setUp(){
		$this->trans = array();
		$this->account = new Account("Savings", "credit");
	}
	/**
	 * @runInSeparateProcess
	 */
	public function testSetNumber(){
		$this->account->setNumber(50);
		$this->assertEquals(50, $this->account->accountNumber);
	}

/*	public function testGetNumber(){
		$this->account->number=50;
		$expected = 50;
		$actual = $this->getNumber();
		$this->assertEquals($actual, $expected);
	}
*/
	/**
	 * @runInSeparateProcess
	 */
	public function testGetName(){
		$actual = $this->account->getName();
		$expected = "Savings";
		$this->assertEquals($expected, $actual);
	}
	/**
	 * @runInSeparateProcess
	 */
	public function testGetHistory(){
		$actual = $this->account->getHistory();
		$expected = $this->trans;
		$this->assertEquals($actual, $expected);
	}
	/**
	 * @runInSeparateProcess
	 */
	public function testGetBalance(){
		$expected = 0;
		$actual = $this->account->getBalance();
		$this->assertEquals($actual, $expected);
	}

/*	public function testGetLastTransaction(){
		$tran = new Transaction("savings", 2/31/23, 59, "tom");
		$this->account->addTransaction($tran);
		$this->assertEquals($tran, $this->account->getLastTransaction());
	}
*/
/*	public function testAddTransaction(){
		$prior = count($this->account->transactionHistory);
		$tran = new Transaction("savings", 2/31/23, 59, "tom");
		$this->account->addTransaction($tran);
		$now = count($this->account->transactionHistory);
		$this->assertEquals($prior, $now + 1);
	}*/
}
?>
