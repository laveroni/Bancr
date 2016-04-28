<?php
//Done need coverage
//problem with remove account, for net all the transactions run in one of the
//for statements, so the other one is never called
require_once "/var/www/html/Bancr/scripts/user.php";

class UserTest extends PHPUnit_Framework_TestCase{
	
	protected $acc;
	protected $accounts;
	protected $user;
	
	protected function setUp(){
		$this->user = new User("ttrojan@usc.edu","rasmuslerdorf");
		$this->accounts = array();
		$this ->acc = new Account("Bryan", 2);
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
		$this->invokeMethod($users, 'addTransaction', array("Johns", "1/01/01", 170, "Bob", "Food"));
		$accountNumber = 4;
		$accs = $users->getAccountsArray();
		$this->assertFalse(array_key_exists($accountNumber, $accs));
	}

	public function testAddTransactionSuccess(){
		$users = new User("ttrojan@usc.edu", "pass");
		$this->invokeMethod($users, 'addTransaction', array("Johns", "1/01/01", 170, "Bob", "Food"));
		$accs = $users->getAccountsArray();
		$a = $accs[3];
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
		$users = new User("ttrojan@usc.edu", "pass");
		$acc = new Account("Billy", 3);
		$users->addAccount($acc);
		$this->invokeMethod($users, 'addTransaction', array("Billy", "1/01/01", 170, "Bob", "Food"));
		$this->invokeMethod($users, 'addTransaction', array("Billy", "1/01/01", -170, "Bob", "Entertainment"));
		$users->removeAccount($acc);
		$accountArray = $users->getAccountsArray();
		$this->assertEquals(3, count($accountArray));
	}
	public function testAddTransactionSuccessAccountAlreadyExists(){
		$users = new User("ttrojan@usc.edu", "pass");
		$this->invokeMethod($users, 'addTransaction', array("Liabilities", "1/01/01", -170, "Bob", "Transportation"));
		$accs = $users->getAccountsArray();
		$a = $accs[1];
		$trans = $a -> getHistory();
		$tran = $trans[0];
		$this->assertEquals("1/01/01", $tran->getDate());
	}

}
?>
