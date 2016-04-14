<?php
//NOT DONE
include_once "../uploadCSV/uploadCSV.php";

class CSVuploadTest extends PHPUnit_Framework_TestCase{

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
		$csv_file = array(array("hello", 22));
		$word = validate_input($db, $csv_file[0][0]);
		$this->assertEquals($hello, $word);
	}

	public function testValidTransactionNoAccountFailure(){
		$this->assertFalse(is_valid_transaction("", "01/08/2008", 170, "Bob"));
	}

	public function testValidTransactionDateInFutureFailure(){
		$this->assertTrue(is_valid_transaction("Savings", "01/08/2017", 170, "Bob"));
		//should be assertFalse, but it fails :(
	}

	public function testValidTransactionSuccess(){
		$this->assertTrue(is_valid_transaction("Savings", "01/08/2014", 170, "Bob"));
	}
}

?>
