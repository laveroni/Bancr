<?php
//Done need coverage
require_once "../UserClass/User.php";

/**
 * @runInSeparateProcess
 */
class UserTest extends PHPUnit_Framework_TestCase{
	
	protected $accounts;
	protected $user;
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
	public function testGetEmail(){
		$actual = $this->user->getEmail();
		$expected = "ttrojan@usc.edu";
		$this->assertEquals($expected, $actual);
	}

	public function testAddTransaction(){
		$this->transaction = new Transaction(32112, 50,"food", "taco bell");
		array_push($this->accounts, $this->transaction);
		$this->assertEquals($this->transaction, end($this->accounts));
	}
}
?>
