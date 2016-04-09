<?php
//Done need coverage
require_once "../UserClass/User.php";
require_once "../account/account.php";

class UserTest extends PHPUnit_Framework_TestCase{
	
	protected $acc;
	protected $accounts;
	protected $user;
	
	protected function setUp(){
		$this->user = new User("ttrojan@usc.edu","rasmuslerdorf");
		$this->accounts = array();
		$this ->acc = new Account("Bryan", "Savings");
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

	/*public function testAddTransactions(){

	}*/

	public function testAddAccount(){
		$this->user->addAccount($this->acc);
		$accs = $this->user->getAccountsArray();
		$this->assertEquals($accs[0], $this->acc);
	}

	public function testRemoveAccount(){
		$this->user->removeAccount($this->acc);
		$accs = $this->user->getAccountsArray();
		$this->assertEquals(0, count[$accs]);
	}

}
?>
