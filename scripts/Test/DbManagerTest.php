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
	public function testOpenConnection(){
		$db = new dbManager();
		$db->openConnection();
		$db_conn = $db->getCon();
		$this->assertFalse($db_conn);
		$db->closeConnection();
	}
	public function testCloseConnectionAfterOpeningConnection(){
		$db = new dbManager();
		$db->openConnection();
		$db->closeConnection();
		$db_conn = $db->getCon();
		$this->assertFalse($db_conn);
	}
	public function testCloseConnectionWithoutOpeningConnection(){
		$db = new dbManager();
		$db->closeConnection();
		$db_conn = $db->getCon();
		$this->assertFalse($db_conn);
	}
}
?>
