<?php
//Done need coverage
require_once "../User.php";

class UserTest extends PHPUnit_Framework_TestCase{
	
	protected $acc;
	protected $accounts;
	protected $user;
	
	protected function setUp(){
		$this->user = new User("ttrojan@usc.edu","rasmuslerdorf");
		$this->accounts = array();
		$this ->acc = new Account("Bryan", 3);
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

	public function testSetEncryptedPassword(){
		$users = new User("ttrojan@usc.edu", "pass");
		$this->invokeMethod($users, 'setEncryptedPassword', array("newPass"));
		$expected = "newPass";
		$this->assertEquals($this->invokeMethod($users, 'getEncryptedPassword', array()), $expected);
	}

	public function testGetAccountNumber(){
		$expected = 3;
		$actual = $this->user->getNumAccounts();
		$this->assertEquals($expected, $actual);
	}
	
	public function testGetEmail(){
		$actual = $this->user->getEmail();
		$expected = "ttrojan@usc.edu";
		$this->assertEquals($expected, $actual);
	}

	public function testAddTransactionFailure(){
		$users = new User("ttrojan@usc.edu", "pass");
		$this->invokeMethod($users, 'addTransaction', array("1/011/01", 170, "Savings", "Bob", 0));
		$accountNumber = 3;
		$accs = $users->getAccountsArray();
		$this->assertFalse(array_key_exists($accountNumber, $accs));
	}

	public function testAddTransactionSuccess(){
		$users = new User("ttrojan@usc.edu", "pass");
		$users->addAccount($this->acc);
		$this->invokeMethod($users, 'addTransaction', array("1/01/01", 170, "Savings", "Bob", 0));
		$accountNumber = 3;
		$accs = $users->getAccountsArray();
		$a = $accs[$accountNumber];
		$trans = $a -> getHistory();
		$tran = $trans[0];
		$this->assertEquals("1/01/01", $tran->getDate());
	}

	public function testAddAccount(){
		$this->user->addAccount($this->acc);
		$accs = $this->user->getAccountsArray();
		$this->assertEquals($accs[3], $this->acc);
	}

	public function testRemoveAccount(){
		$this->user->removeAccount($this->acc);
		$accs = $this->user->getAccountsArray();
		$this->assertEquals(3, count($accs));
	}

}
?>
