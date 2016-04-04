<?php
//NOT DONE
include_once "../account/account.php";
include_once "../Transaction/transaction.php";

class TranactionTest extends PHPUnit_Framework_TestCase{

	protected $transaction;
	protected $acc;

	protected function setUp(){
		$this->acc = new Account("Check", 3000, null);
		$this->transaction = new Transaction("Saves","01/01/16",100,"Ted");
	}

	public function testSetAccount(){
		$this->transacction->setAccount($this->acc);
		$this->assertEquals($this->acc, $this->transaction->$account);
	}

	public function testSetDate(){
		$this->transaction->setDate("03/23/10");
		$this->assertEquals("03/23/10", $this->transaction->$date);
	}

	public function testSetMerchant(){
		$this->transaction->setMerchant("John");
		$this->assertEquals("John",$this->transaction->$merchant);
	}


	public function testSetAmount(){
		$this->transaction->setAmount(100);
		$this->assertEquals(100, $this->transaction->$amount);
	}

	public function testGetAccount(){
		$this->transaction->account = $this->acc;
		$actual = $this->transaction->getAccount();
		$this->assertEquals($this->acc, $actual);
	}

	public function testGetDate(){
		$this->transaction->$date = "01/12/13";
		$actual = $this->transaction->getDate();
		$this->assertEquals("01/12/13", $actual);
	}

	public function testGetAmount(){
		$this->transaction->$amount = 90;
		$actual = $this->transaction->getAmount();
		$this->assertEquals(90, $actual);
	}

	public function testGetMerchant(){
		$this->transaction->$merchant = "Don";
		$actual = $this->transaction->getMerchant();
		$this->assertEquals("Don", $actual);
	}
}



?>