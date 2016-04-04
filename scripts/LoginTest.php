<?php
//require_once("../../index.php");
require_once("../login/signin.php"); 
class LoginTest extends PHPUnit_Framework_TestCase
{
    // TEST
    // ensures the sign in information is valid
	public function testSignInValid() {
		$this->assertEquals(
			'success', 
			verify('bancr@usc.edu', 'password')
		); 
	}
    // TEST
    // ensures we can't sign in with invalid information
	public function testSignInInvalid() {
		$this->assertEquals(
			'error', 
			verify('julias@usc.edu', 'password')
		); 
	}
	
    // TEST
    // ensures we can't sign in if we dont' provide a valid email and password
	public function testSignInNoUsernameOrPassword() {
		$this->assertEquals(
			'error',
			verify('', '')
		);
	}
    // TEST
    // ensures we can't sign in without a username
	public function testSignInNoUsername() {
		$this->assertEquals(
			'error',
			verify('', 'password')
		);
	}
    // TEST
    // ensures we can't sign in without a password
	public function testSignInNoPassword() {
		$this->assertEquals(
			'error',
			verify('bancr@usc.edu', '')
		);
	}
}
?>
