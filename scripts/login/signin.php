<?php 

//function for incorrect sign in
function incorrectEmail() {
	?>
	<script type="text/javascript">
		window.location = "../../index.html";
		alert("Incorrect email/password");
	</script>  
<?php
}
function goToSleep(){
	?>
	<script type="text/javascript">
		window.location = "../disable.html";
		alert("Incorrect 4 times. Will time out for 1 minute");
		//window.setTimeout(sleepB, 20000);
	</script>
<?php
}

function test_input($db, $data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($db->getCon(), $data);
    return $data;
}

function hash_password($password) {
	return password_hash($password, PASSWORD_DEFAULT);
}

if(isset($_POST['submit']))
{
	
		//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
		ini_set('display_errors', 'On');
		error_reporting(E_ALL | E_STRICT);
		//REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION


		//create the user's session
		session_start(); 

		//database configuration file containing db login credentials
	    require_once('../db/db_manager.php');
	    require_once('../UserClass/User.php');

	    //checks if the session variable loggedIn is set
	    //then validates that loggedIn is true and the user is logged in
	    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
	    {
	    	//if the user is loggedIn already then it redirects the page to the homepage
	        header('Location: ../../dashboard/');
	        exit();
	    }

	    //create a db class object, open connection
	    $db = new dbManager();
	    $db->openConnection();

		$email = test_input($db, $_POST["email"]);
	    $password = test_input($db, $_POST["password"]);
	    // Hash password
		$hpassword = md5($password);
		//file_put_contents('php://stderr', print_r($password, TRUE));

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
	    	if($hpassword == $row[2]) {
	    		// Create User object
				$user = new User($email, $hpassword);

	    		//Store appropriate session variables
	    		$_SESSION['email'] = $email;
	        	$_SESSION['password'] = $hpassword;
	        	$_SESSION['loggedIn'] = TRUE;
				$_SESSION['user'] = $user;

	        	header('Location: ../../dashboard/');
	        	exit();
	    	}
	    	else {
	    		incorrectEmail();
	    	}

	    }
	    else {
	    	incorrectEmail();
	    }
}

?>