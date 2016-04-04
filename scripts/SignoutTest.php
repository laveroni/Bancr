<?php
require_once("../logout/logout.php");
class SignoutTest extends PHPUnit_Framework_TestCase
{
    // TEST
    // ensures that sign out for the signed in user works
	public function testSignOutValid() {
		$this->assertEquals(
			true, 
			signOut('bancr@usc.edu')
		); 
	}
    // TEST
    // ensures that sign out for random users doesn't work
	public function testSignOutInvalid() {
		$this->assertEquals(
			false, 
			signOut('')
		); 
	}
}
?>
