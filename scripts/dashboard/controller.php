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
$user = '';

if(!isset($_SESSION['userObject'])) {
	$db = new dbManager();
	$db->openConnection();

	$query = "SELECT * FROM Users WHERE Email = '$email'";
	$result = $db->queryRequest($query);
	$row = mysqli_fetch_row($result);


	$user = $row[2];
	$user = base64_decode($user);
	$user = unserialize($user);

	$_SESSION['userObject'] = $user;

	file_put_contents('php://stderr', print_r('h', TRUE));

	$db->closeConnection();

} else {
	$user = $_SESSION['userObject'];
}

file_put_contents('php://stderr', print_r($_SESSION['userObject']->getAccountsArray(), TRUE));



/*
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
*/
?>

<?php
/*
// Add account funcitonality:
// Check for session account variables
// OR
// Check db for account info with no history
// If account valid (Doesn't already exist/Blank field)
// Add that account to user info
// Make sure those accounts display
// Let user know those accounts have no transaction data ??
if(isset($_POST['addAccount']))
{
	if(isset($_POST["accountName"]) && $_POST["accountName"] != "")
	{
		// $_SESSION['addAccountError'] = "";

		$testAccounts = $_SESSION['userObject']->getAccountsArray();
		
		// Check whether account already exists
		foreach ($testAccounts as $key => $value)
		{ 
			if($value->getName() == $_POST["accountName"])
			{
				$_SESSION['addAccountError'] = "<br>Error: Account Name Already Exists";
				break;
			}
			
		}	

		if(!isset($_SESSION['addAccountError']))
		{
			$newAccount = new Account($_POST["accountName"], $_POST['accountTypeInput']);

			$_SESSION['userObject']->addAccount($newAccount);	
			header("Location: dashboard.php");
			exit();
		}
	}
	else
	{
		$_SESSION['addAccountError'] = "<br>Error: Enter Account Name";
	}
}
*/
?>