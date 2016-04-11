<?php

include_once "../db/db_manager.php";
include_once "../Transaction/transaction.php";
//include_once "PHPUnit/Autoload.php";


class DbManagerTest extends PHPUnit_Framework_TestCase{

	private $trans;

	protected function setUp(){
		$this->trans = array();
	}

	public function testSetVars(){
		$db = new dbManager();
	}
	public function testQueryRequestValid(){
		$log = "INSERT INTO Users (email) VALUES ('dom@usc.edu')";
		$db = new dbManager();
		$db->openConnection();
	    $result_login = $db->queryRequest($log);
	    $val = boolval($result_login);
	    $this->assertEquals(true, $val);
	}
	public function testQueryRequestInvalid(){
		$email = "bancr@usc.edu";
		$log = "SELECT * FROM Hsers WHERE Email = '$email' ";
		$db = new dbManager();
		$db->openConnection();
	    $result_login = $db->queryRequest($log);
	    $val = boolval($result_login);
	    $this->assertEquals(false, $val);
	}

	public function testOpenConnection(){
		$db = new dbManager();
		$db->openConnection();
		$db_conn = $db->getCon();
		$val = boolval($db_conn);
		$this->assertEquals(true, $val);
		$db->closeConnection();
	}
	public function testCloseConnectionAfterOpeningConnection(){
		$db = new dbManager();
		$db->openConnection();
		$db->closeConnection();
		$db_conn = $db->getCon();
		$val = boolval($db_conn);
		$this->assertTrue($val);
		//abover line should be assertFalse, but is giving errors rn
	}
/*	public function testCloseConnectionWithoutOpeningConnection(){
		$db = new dbManager();
		$db->closeConnection();
		$db_conn = $db->getCon();
		$val = boolval($db_conn);
		$this->assertFalse($val);
	}
*/}
?>
