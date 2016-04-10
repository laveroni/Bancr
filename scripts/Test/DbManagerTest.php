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
}
?>
