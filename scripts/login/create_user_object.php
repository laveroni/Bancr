<?php

    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);

	session_start();

	if($_SESSION['loggedIn'] == FALSE)
	{
		header('Location: ../login/login_page.php');
		exit();
	}

	$email = $_SESSION['email'];
	$encryptedPassword = $_SESSION['pass'];
	$newUser = $_SESSION['newUser'];

	//database configuration file containing db login credentials
    require_once('../db/db_manager.php');
    include_once('../UserClass/User.php');
    require_once('../PortfolioClass/PortfolioClass.php');

    //create a db class object, open connection
    $db = new dbManager();
    $db->openConnection();

	$query = "SELECT * FROM users WHERE Email = '$email'";

	$result = $db->queryRequest($query);

    $row = mysqli_fetch_row($result);


    if($newUser == TRUE)
    {
    	$portfolio = new Portfolio();
    }
    else
    {
    	//get serialized portfolio object from database
		$portfolio = unserialize($row[3]);    	
    }



    //create instance of user class
    $user = new User($email,$encryptedPassword, $row[2], $portfolio);

    $_SESSION['userObject'] = $user;

    $_SESSION['newUser'] = FALSE;


    $db->closeConnection();


    header('Location: ../portfolio/portfolio.php');
    exit();

?>