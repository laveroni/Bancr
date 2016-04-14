<?php 

//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
//REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

require_once('db_manager.php');

//create the user's session
session_start();

//checks if the session variable loggedIn is set
//then validates that loggedIn is true and the user is logged in
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
{
    //if the user is loggedIn already then it redirects the page to the homepage
    file_put_contents('php://stderr', print_r('2', TRUE));
    header('Location: ../dashboard/index.php');
    exit();
}

//check if loginAttempts is equal to 4
if(!isset($_SESSION['loginAttempts']))
{
    $_SESSION['loginAttempts'] = 0;
}

if(isset($_POST['submit']) && isset($_POST["password"]) && isset($_POST["email"]))
{
    //create a db class object, open connection
    $db = new dbManager();
    $db->openConnection();

    $password = test_input($db, $_POST["password"]);
	$email = test_input($db, $_POST["email"]);

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
        	header('Location: ../dashboard/index.php');
        	exit();
    	}
    	else
    	{
            $_SESSION['loginAttempts'] += 1;
    	}
    }
    else
    {
        $_SESSION['loginAttempts'] += 1;
    }

} 
else if(isset($_POST['submit']) && (!isset($_POST["password"]) || !isset($_POST["email"])))
{
    $_SESSION['loginAttempts'] += 1;  
}

header('Location: ../');

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
	return password_hash($password, PASSWORD_DEFAULT);
}

function verify($password, $hash) 
{
	return password_verify($password, $hash);
}
?>