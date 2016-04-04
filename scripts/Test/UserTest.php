<?php
//Done need coverage
require_once "../UserClass/User.php";

class UserTest extends PHPUnit_Framework_TestCase{

	protected function setUp(){
		$this->user = new User("ttrojan@usc.edu","Ladida");
	}

	public function testSetEncryptedPassword(){
		$this->user->setEncryptedPassword("pass");
		$this->assertEquals("pass", $this->user->$encryptedPassword);
	}
	
	public function testGetEncryptedPassword(){
		$this->method('getPass')->willReturn('foo');
		$this->assertEquals('foo', $this->user->getPass());
	}

	public function testGetEmail(){
		$actual = $this->account->getEmail();
		$expected = "ttrojan@usc.edu";
		$this->assertEquals($expected, $actual);
	}

	public function testAddTransaction(){
		$this->transaction = new Transaction(32112, 50, food, taco bell);
		$this->array_push($this->accounts[0], $this->transaction);
		$this->assertEquals($this->transaction, $this->end($this->accounts));
	}
?>