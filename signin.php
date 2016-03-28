<?php
//function for correct sign in 
//$fail = 0;
function signIn() { ?>
	<script type="text/javascript">
		window.location = "dashboard.html";
	</script>  
<?php 
}
//function for incorrect sign in
function incorrectEmail() {
	?>
	<script type="text/javascript">
		window.location = "index.html";
		alert("Incorrect email/password");
	</script>  
<?php
}
function goToSleep(){
	?>
	<script type="text/javascript">
		window.location = "disable.html";
		alert("Incorrect 4 times. Will time out for 1 minute");
		//window.setTimeout(sleepB, 20000);
	</script>
<?php
}
if(isset($_POST['submit']))
{
	//global $test;
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	//connecting to the database
	$db = new mysqli("127.0.0.1", "root", "#Ntgnixel15", "bancr_database");
	//checking for errors 
	if($db->connect_errno > 0){
		//error_log("ERROR!! DATABASE ERROR");
    	die('Unable to connect to database [' . $db->connect_error . ']');
	}
	//DB query
	//input validation, so can't do a sql injection
	if (strpos($email, ";") == false && strpos($email, "'") == false && strpos($email, "-")==false && strpos($password, ";") == false && strpos($password, "'") == false ){
		$result = $db->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
		//checking if any results 
		if (mysqli_num_rows($result) == 0) {
			//no results (incorrect login)
			/*$fail++;
			if($fail > 0)
				goToSleep();*/
			incorrectEmail();
		} else {
			//yes results (correct login)...redirect them to the dashboard
			signIn();
		}
	}
	else{
		incorrectEmail();
	}
}

?>