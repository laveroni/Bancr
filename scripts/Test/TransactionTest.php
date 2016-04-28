<?php
//NOT DONE
include_once "/var/www/html/Bancr/scripts/account.php";
include_once "/var/www/html/Bancr/scripts/transaction.php";

class TranactionTest extends PHPUnit_Framework_TestCase{

	protected $transaction;

	protected function setUp(){
		$this->transaction = new Transaction("Saves","01/01/16", 100, "Ted", "Food");
	}
	
	public function testGetAccount(){
		$expected = "Saves";
		$actual = $this->transaction->getAccount();
		$this->assertEquals($expected, $actual);
	}
	
	public function testGetDate(){
		$expected = "01/01/16";
		$actual = $this->transaction->getDate();
		$this->assertEquals($expected, $actual);
	}
	
	public function testGetAmount(){
		$expected = 100;
		$actual = $this->transaction->getAmount();
		$this->assertEquals($expected, $actual);
	}
	
	public function testGetMerchant(){
		$expected = "Ted";
		$actual = $this->transaction->getMerchant();
		$this->assertEquals($expected, $actual);
	}

	public function testGetBudget(){
		$expected = "Food";
		$actual = $this->transaction->getBudget();
		$this->assertEquals($expected, $actual);
	}
}
?>
