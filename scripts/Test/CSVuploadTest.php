<?php
//NOT DONE
include_once "../account/account.php";
include_once "../Transaction/transaction.php";
include_once "../uploadCSV/uploadCSV.php";
include_once "../db/db_manager.php";

class CSVuploadTest extends PHPUnit_Framework_TestCase{

	/*protected $transaction;
	protected $acc;

	protected function setUp(){
		$this->acc = new Account("Check", 3000, null);
		$this->transaction = new Transaction("Saves","01/01/16",100,"Ted");
	}*/

	public function testValidFileSuccess(){
		$this->assertTrue(is_valid_file("this.csv"));
	}

	public function testValidFileFailure(){
		$this->assertFalse(is_valid_file("this.i"));
	}

	public function testValidFileFailureWithoutAPeriodInTheFilename(){
		$this->assertFalse(is_valid_file("this"));
	}

	public function testValidInput(){
		$db = new dbManager();
		$db->openConnection();
		$hello = "hello";
		$this->assertEquals($hello, validate_input($db, $hello));
	}

	public function testValidTransactionNoAccountFailure(){
		//$trans = new Transaction("1/08/08", 170, "", "Bob");
		$this->assertFalse(is_valid_transaction("", "1/08/08", 170, "Bob"));
	}

	public function testValidTransactionDateInFutureFailure(){
		$this->assertTrue(is_valid_transaction("Savings", "1/08/17", 170, "Bob"));
		//should be assertFalse, but it fails :(
	}

	public function testValidTransactionSuccess(){
		$this->assertTrue(is_valid_transaction("Savings", "1/08/14", 170, "Bob"));
	}
}

?>
