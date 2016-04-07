<?php 

    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);


    require_once('../db/db_manager.php');
    include_once('../UserClass/User.php');

    
	//unset session data, destroy session data, and redirect to login page
	session_start();

	//database configuration file containing db login credential


    //need to store serialized portfolio and balance

    // $email = $_SESSION['email']; 

    // $user = $_SESSION['userObject'];



    //$serial = serialize($user);


    //create a db class object, open connection
    //$db = new dbManager();
    //$db->openConnection();

	// $query = "UPDATE Users SET Balance = '$balance', Portfolio = '$serial' WHERE Email = '$email'";

	// $result = $db->queryRequest($query);

	//$db->closeConnection();



	unset($_SESSION);
	session_destroy();
	header('Location: ../../index.php');
	exit();

?>