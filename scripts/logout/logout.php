<?php 
    session_start();

    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);


    require_once('../db/db_manager.php');
    require_once('../UserClass/User.php');

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
