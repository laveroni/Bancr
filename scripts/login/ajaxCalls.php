<?php

	//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);
	//REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION


	//create the user's session
	session_start(); 

	//database configuration file containing db login credentials
    require_once('../db/db_manager.php');

    //checks if the session variable loggedIn is set
    //then validates that loggedIn is true and the user is logged in
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
    {
    	//if the user is loggedIn already then it redirects the page to the homepage
        header("Location: create_user_object.php");
        exit();
    }

    //create a db class object, open connection
    $db = new dbManager();
    $db->openConnection();



	if (isset($_POST['action'])) 
	{
	    $result = $_POST['action'];
	    
	    switch($result) 
	    {
			case "signIn":
				$password = test_input($db, $_POST["password"]);
				$email = test_input($db, $_POST["email"]);
				$success = signIn($email, $password);
				return $success;
			break;
		}
	}

	//error_log($result);
	function signIn($email, $password) 
	{
		//log is a variable holding the database command to locate user based on name and password
	   	$log = "SELECT * FROM Users WHERE Email = '$email' ";

	    //actually query the database with the given command
	    $result_login = $db->queryRequest($log);

	    //displays the number of rows that are returned, should not be 0
	    //if 0, then the user input was not found and either incorrect input was given
	    //or the user is not registered
	   	$row_cnt = mysqli_num_rows($result_login);
	    $row = mysqli_fetch_row($result_login);

	    if( $row_cnt == 1 )
	    { // logs user in.

	    	//verify that the password and the hash are the same, if not log in is incorrect
	    	if(verify($password, $row[1]))
	    	{
	    		//store username and hashed password as session variables
	    		$_SESSION['email'] = $email;
	        	$_SESSION['password'] = $row[1];
	        	$_SESSION['loggedIn'] = TRUE;

	        	// header('Location: create_user_object.php');
	        	// exit();

	        	//yes results (correct login)...redirect them to the dashboard
				return 'success';
	    	}
	    	else
	    	{
	    		return 'error';
	    	}

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


	// function hash($password) 
	//{
	//	return password_hash($password, PASSWORD_DEFAULT);
	//}

	function verify($password, $hash) 
	{
    	return password_verify($password, $hash);
	}


?>
