<?php
require_once("../login/ajaxCalls.php");
require_once("../login/signin.php"); 
class LoginTest extends PHPUnit_Framework_TestCase
{
    // TEST
    // ensures the sign in information is valid
	public function testSignInValid() {
		$this->assertEquals(
			'success', 
			signIn('bancr@usc.edu', 'password')
		); 
	}
    // TEST
    // ensures we can't sign in with invalid information
	public function testSignInInvalid() {
		$this->assertEquals(
			'error', 
			signIn('julias@usc.edu', 'password')
		); 
	}
	
    // TEST
    // ensures we can't sign in if we dont' provide a valid email and password
	public function testSignInNoUsernameOrPassword() {
		$this->assertEquals(
			'error',
			signIn('', '')
		);
	}
    // TEST
    // ensures we can't sign in without a username
	public function testSignInNoUsername() {
		$this->assertEquals(
			'error',
			signIn('', 'password')
		);
	}
    // TEST
    // ensures we can't sign in without a password
	public function testSignInNoPassword() {
		$this->assertEquals(
			'error',
			signIn('bancr@usc.edu', '')
		);
	}
}
?