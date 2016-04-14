<?php
//NOT DONE
include_once "../account.php";
include_once "../transaction.php";

class TranactionTest extends PHPUnit_Framework_TestCase{

	protected $transaction;

	protected function setUp(){
		$this->transaction = new Transaction("01/01/16",100, "Saves", "Ted");
	}

	/*public function testSetAccount(){
		$this->transaction->setAccount($this->acc);
		$this->assertEquals($this->acc, $this->transaction->$account);
	}*/

/*	public function testSetDate(){
		$this->transaction->setDate("03/23/10");
		$this->assertEquals("03/23/10", $this->transaction->$date);
	}
*/
/*	public function testSetMerchant(){
		$this->transaction->setMerchant("John");
		$this->assertEquals("John",$this->transaction->$merchant);
	}
*/

/*	public function testSetAmount(){
		$this->transaction->setAmount(100);
		$this->assertEquals(100, $this->transaction->$amount);
	}
*/
	
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
}



?>
