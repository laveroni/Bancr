<?php
//Done need coverage
require_once "../UserClass/User.php";

class UserTest extends PHPUnit_Framework_TestCase{
	
	/**
 	* @runInSeparateProcess
	 */

	protected $accounts;
	protected $user;
	/**
 	* @runInSeparateProcess
	 */
	protected function setUp(){
		$this->user = new User("ttrojan@usc.edu","Ladida");
		$this->accounts = array();
	}
	
/*	public function testGetEncryptedPassword(){
		$actual = $this->getPass();
		$expected = "Ladida";
		$this->assertEquals($actual, $expected);
	}
*/
	/**
 	* @runInSeparateProcess
	 */
	public function testGetEmail(){
		$actual = $this->user->getEmail();
		$expected = "ttrojan@usc.edu";
		$this->assertEquals($expected, $actual);
	}
	/**
 	* @runInSeparateProcess
	 */
	public function testAddTransaction(){
		$this->transaction = new Transaction(32112, 50,"food", "taco bell");
		array_push($this->accounts, $this->transaction);
		$this->assertEquals($this->transaction, end($this->accounts));
	}
}
?>
