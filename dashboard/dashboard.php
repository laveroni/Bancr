<?php

//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
//REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

require_once("../scripts/db_manager.php");
require_once("../scripts/user.php");

session_start();
// Check whether user is logged in
if($_SESSION['loggedIn'] == false || $_SESSION['loggedIn'] == null)
{	
	header('Location: ../index.php');
	exit();
}

// Get user email
if(!isset($_SESSION['email']) || !isset($_SESSION['password']) ) 
{
	header('Location: ../index.php');
	exit();
}

$email = $_SESSION['email'];

// Instatiate user if new user
if(isset($_SESSION['newUser']) && $_SESSION['newUser'])
{	
	$user = new User($email, $_SESSION['password']);
	$_SESSION['userObject'] = $user;
	unset($_SESSION['newUser']);
}

// Unserialize user object
if(!isset($_SESSION['userObject'])) 
{
	$db = new dbManager();
	$db->openConnection();

	$query = "SELECT * FROM Users WHERE Email = '$email'";
	$result = $db->queryRequest($query);
	$row = mysqli_fetch_row($result);

	$user = $row[2];
	$user = base64_decode($user);
	$user = unserialize($user);

	$_SESSION['userObject'] = $user;

	$db->closeConnection();

	//$_SESSION['userObject'] = new User($email, $_SESSION['password']);
}

$user = $_SESSION['userObject'];

// Adding account functionality
if(isset($_POST['addAccount']))
{
	if(isset($_POST['accountName']) && $_POST['accountName'] != "")
	{
		$accounts = $user->getAccountsArray();
		$exists = false;
		// Check whether account already exists
		foreach ($accounts as $key => $value)
		{ 
			if($value->getName() == $_POST['accountName'])
			{
				$exists = true;
			}
		}	
		if(!$exists)
		{
			$newAccount = new Account($_POST["accountName"], $_SESSION['userObject']->getNumAccounts());
			$_SESSION['userObject']->addAccount($newAccount);
			
			header("Location: index.php");
			exit();
		} 
		else 
		{
			?>
			<script type='text/javascript'>
				alert("Account already exists.");
			</script>
			<?php
		}
	}
	else
	{
		?>
		<script type='text/javascript'>
			alert("Please enter an account name.");
		</script>
		<?php
	}
	unset($_POST['addAccount']);
}

// CSV Upload message
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


if (isset($_POST['removeAccount'])) 
{
  	$accountsArray = $_SESSION['userObject']->getAccountsArray();
	$newAccountObject = $accountsArray[$_POST['id']];
	$_SESSION['userObject']->removeAccount($newAccountObject);
	header("Location: index.php");
	exit();
}



if(isset($_POST['addTransaction']))
{
		
	if(isset($_POST["transactionName"]) && $_POST["transactionName"] != "" && isset($_POST["transactionAmount"]) && $_POST["transactionAmount"] != "" && isset($_POST["transactionMerchant"]) && $_POST["transactionMerchant"] != "" && isset($_POST["transactionDate"]) && $_POST["transactionDate"] != "")
	{
		$transAccounts = $_SESSION['userObject']->getAccountsArray();
		$arrayKey = 0;
		foreach ($transAccounts as $key => $value)
		{ 
			if($value->getName() == $_POST["transactionName"])
			{
				$arrayKey = $key;
			}
				
		}
		$_SESSION['userObject']->addTransaction($_POST["transactionName"], $_POST["transactionDate"], $_POST["transactionAmount"], $_POST["transactionMerchant"], $arrayKey);
		header("Location: index.php");
		exit();
			
	}
	else
	{

	}
		
}




// Encode transaction data for graph
$transactions_json = array();
$accounts = $user->getAccountsArray();
foreach ($accounts as $a)
{ 
	$history = $a->getHistory();
	foreach ($history as $t) 
	{
		$account = $a->getName();
		$date = $t->getDate();
		$amount = (float) $t->getAmount();
		$merchant = $t->getMerchant();
		$transactions_json[] = array('account' => $account, 'date' => $date, 'amount' => $amount, 'merchant' => $merchant);
	}
}
// file_put_contents('php://stderr', print_r($transactions_json, TRUE));
?>