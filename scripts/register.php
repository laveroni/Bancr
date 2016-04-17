<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

session_start();


$_SESSION['loggedIn'] = FALSE;

//database configuration file containing db login credentials
require_once('./db_manager.php');

//create a db class object, open connection
$db = new dbManager();
$db->openConnection();

// $usernameError = "";
$passwordError = "";
$repeatPasswordError = "";
$emailError = "";
$registrationError = "";


if (isset($_POST['submit'])) {

	// $username = $_POST["name"];
	$password = $_POST["password"];
	$email = $_POST["email"];

	// if (empty($_POST["name"])) {
	// 	$usernameError = "Username is required";
	// }
	// else {
	// 	$usernameError = "";
	// 	$username = test_input($db, $_POST["name"]);
	// }

	if (empty($_POST["password"])) {
		$passwordError = "Password is required";
	}
	else {
		$passwordError = "";
		$password = test_input($db, $_POST["password"]);
	}

	if (empty($_POST["email"])) {
		$emailError = "Email is required";
	}
	else {
		$emailError = "";
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) 
		{
 			$emailError = "";
		} 
		else 
		{
 			$emailError = "Invalid email address";
		}

		//determine if username is already taken
		$user_log = "SELECT Email FROM users WHERE Email = '$email' ";
	
		$unique_user = $db->queryRequest($user_log);
	
		//there was already a user with the same username
		if(mysqli_num_rows($unique_user) != 0)
		{
			$emailError = "Email is already registered";
		}
		
	}
	
	if(empty($_POST["password2"]))
	{
		$repeatPasswordError = "Please Verify Password";
	}
	else
	{
		$repeatPasswordError = "";
	}
	
	//make sure that both passwords are equal
	if( strcmp($_POST["password"], $_POST["password2"]) !== 0 )
	{
		$repeatPasswordError = "Passwords do not match";
	}
	else
	{
		$repeatPasswordError = "";
	}

		//if all of the information is valid and not taken, register user
	if( $passwordError == "" && $repeatPasswordError == "" && $emailError == "" && $registrationError == "")
	{
		//hash password first 
		$password = hashit($password);
		
		$log = "INSERT INTO Users (Password, Email) VALUES ('$password', '$email')";
		
		//actually query the database with the given command
		$result_register = $db->queryRequest($log);
	
		if($result_register === FALSE)
		{
			$registrationError = "Error registering user, please try again";
		}
	
		if($result_register === TRUE && $registrationError == "")
		{
			$_SESSION['password'] = $password;
			$_SESSION['email'] = $email;
			$_SESSION['loggedIn'] = TRUE;
			$_SESSION['newUser'] = TRUE;

			$db->closeConnection();

			header('Location: ../dashboard/index.php');
			exit();
		}

		$db->closeConnection();
	}
}
	
function test_input($db, $data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = mysqli_real_escape_string($db->getCon(), $data);
	return $data;
}

function hashit($password) 
{
	$string = password_hash($password, PASSWORD_DEFAULT);
	return $string;
}
include('./register.html.php');
?>