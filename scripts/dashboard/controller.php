<?php
	
//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
//REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

require_once("../Transaction/transaction.php");
require_once("../account/account.php");
require_once("../db/db_manager.php");
require_once("../UserClass/User.php");

session_start();

if($_SESSION['loggedIn'] == false || $_SESSION['loggedIn'] == null)
{	
	header('Location: ../../index.php');
	exit();
}

if(isset($_SESSION['uploadSuccess']))
{
	if($_SESSION['uploadSuccess'] == true) 
	{
		?>
		<script type='text/javascript'>
			alert("Upload successful");
		</script>
		<?php
		
	} 
	else 
	{
		?>
		<script type='text/javascript'>
			alert("Something went wrong with your upload.");
		</script>
		<?php
	}
	unset($_SESSION['uploadSuccess']);
}

if(!isset($_SESSION['email']) || !isset($_SESSION['password'])) 
{
	header('Location: ../../index.php');
	exit();
}

$email = $_SESSION['email'];
$password = $_SESSION['password'];

// Create user object
$user = new User($email, $password);

// Connect to database to fetch user data from db
$db = new dbManager();
$db->openConnection();

// Fetch all user transactions
$query = "SELECT * FROM transactions WHERE user = '$email' ";
$transactions = $db->queryRequest($query) or trigger_error(mysql_error().$query);

$transactions_json = array();

// Parse transaction/account info from transactions data
while($row = $transactions->fetch_assoc())
{
	$account = $row['account'];
	$date = $row['date'];
	$amount = (float) $row['amount'];
	$merchant = $row['merchant'];

	// Add transaction data to user
    $user->addTransaction($account, $date, $amount, $merchant);
    // Encode transaction data for js
    $transactions_json[] = array('account' => $account, 'date' => $date, 'amount' => $amount, 'merchant' => $merchant);
}

$db->closeConnection();
?>