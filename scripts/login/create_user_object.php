<?php

    //TODO:
    //  potentially include account and transaction classes as member objects of user
    //  user will have these and then we will store the individual elements in the database upon logout
    //  uncomment database connection code below to do that


    //REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    //REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION


	session_start();

    require('../UserClass/User.php');

	if($_SESSION['loggedIn'] == FALSE)
	{
		header('Location: ../../signin.php');
		exit();
	}

	$email = $_SESSION['email'];
	$encryptedPassword = $_SESSION['password'];

	// //database configuration file containing db login credentials
 //    require_once('../db/db_manager.php');

 //    //create a db class object, open connection
 //    $db = new dbManager();
 //    $db->openConnection();

	// $query = "SELECT * FROM users WHERE Email = '$email'";

	// $result = $db->queryRequest($query);

 //    $row = mysqli_fetch_row($result);




    //create instance of user class
    $user = new User($email,$encryptedPassword);

    $_SESSION['userObject'] = $user;


    // $db->closeConnection();


    header('Location: ../../dashboard.php');
    exit();

?>