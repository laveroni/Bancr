<?php
//Done need coverage
require_once "../UserClass/User.php";

class UserTest extends PHPUnit_Framework_TestCase{
	

	protected $accounts;
	protected $user;
	
	protected function setUp(){
		$this->user = new User("ttrojan@usc.edu","rasmuslerdorf");
		$this->accounts = array();
	}

	//used to test private functions
	public function invokeMethod(&$object, $methodName, array $parameters = array()){
    	$reflection = new \ReflectionClass(get_class($object));
    	$method = $reflection->getMethod($methodName);
    	$method->setAccessible(true);

    	return $method->invokeArgs($object, $parameters);
	}


	public function testGetEncryptedPassword(){
		$users = new User("ttrojan@usc.edu", "pass");
		$expected = "pass";
		$this->assertEquals($this->invokeMethod($users, 'getEncryptedPassword', array()), $expected);
	}

	
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
