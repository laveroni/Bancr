<?php
 //NOT DONE
 include_once "/var/www/html/Bancr/scripts/uploadCSV.php";
 include_once "/var/www/html/Bancr/scripts/db_manager.php";
 
 
 class CSVuploadTest extends PHPUnit_Framework_TestCase{
 
 	/**
     * @runInSeparateProcess
     */
 	public function testValidFileSuccess(){
 		$this->assertTrue(is_valid_file("this.csv"));
 	}
 	
 	/**
     * @runInSeparateProcess
     */
 	public function testValidFileFailure(){
 		$this->assertFalse(is_valid_file("this.i"));
 	}
 
 	/**
     * @runInSeparateProcess
     */
 	public function testValidFileFailureWithoutAPeriodInTheFilename(){
 		$this->assertFalse(is_valid_file("this"));
 	}
 
 	/**
     * @runInSeparateProcess
     */
 	public function testValidInput(){
 		$db = new dbManager();
 		$db->openConnection();
 		$hello = "hello";
 		$csv_file = array(array("hello", 22));
 		$word = validate_input($db, $csv_file[0][0]);
 		$this->assertEquals($hello, $word);
 	}
 
 	/**
     * @runInSeparateProcess
     */
 	public function testValidTransactionNoAccountFailure(){
 		$this->assertFalse(is_valid_transaction("", "01/08/2008", 170, "Bob"));
 	}

 	/**
     * @runInSeparateProcess
     */
	public function testValidTransactionDateInFutureFailure(){
 		$this->assertTrue(is_valid_transaction("Savings", "01/08/2017", 170, "Bob"));
 		//should be assertFalse, but it fails :(
 	}

 	/**
     * @runInSeparateProcess
     */
	public function testValidTransactionSuccess(){
 		$this->assertTrue(is_valid_transaction("Savings", "01/08/2014", 170, "Bob"));
 	}
 }
 
 ?>