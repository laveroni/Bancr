<?php
//NOT DONE
include_once "../account/account.php";
include_once "../Transaction/transaction.php";
include_once "../uploadCSV/uploadCSV.php";


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
}

?>
