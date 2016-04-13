<?php 
    session_start();

    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);


    require_once('../db/db_manager.php');
    include_once('../UserClass/User.php');

    
	//unset session data, destroy session data, and redirect to login page
	

	//database configuration file containing db login credential


    //need to store serialized data

    $email = $_SESSION['email']; 

    $user = $_SESSION['userObject'];


    $serial = serialize($user);
    $encodedObject = base64_encode($serial);

    //create a db class object, open connection
    $db = new dbManager();
    $db->openConnection();

	$query = "UPDATE Users SET UserObject = '$encodedObject' WHERE Email = '$email'";

	$result = $db->queryRequest($query);

	$db->closeConnection();



	unset($_SESSION);
	session_destroy();
	header('Location: ../../index.php');
	exit();

?>
