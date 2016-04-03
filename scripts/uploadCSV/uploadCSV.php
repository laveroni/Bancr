<?php
//file_put_contents('php://stderr', print_r('1', TRUE));
require_once('../db/db_manager.php');
require_once('../Transaction/transaction.php');
require_once('../account/account.php');
require_once('../UserClass/User.php');

function is_valid_file($filename) {
    $tmp = explode('.', $filename);
    $ext = end($tmp);
    if($ext != "csv") {
        return false;
    } else {
        return true;
    }
}

function validate_input($db, $data) 
{
    $data = trim($data);
    //$data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($db->getCon(), $data);
    return $data;
}

function is_valid_transaction($account, $date, $amount, $merchant) {

    // Check whether fields are empty
    if( empty($account) || empty($date) || empty($amount) || empty($merchant)) {
        return false;
    }
    // Check whether date valid
    $date = new DateTime($date);
    $transaction_date = $date->format('n/j/Y');
    $current_date = date('n/j/Y');
    if($transaction_date > $current_date) {
        return false;
    }

    return true;
}

session_start();

// CSV Functionality
if(isset($_POST['submit'])) {

    //REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    //REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

    if (!isset($_SESSION['userObject']) || !isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'])
    {
        header('Location: ../../index.php');
        exit();
    }

    $user = $_SESSION['userObject'];
    $email = $_SESSION['email'];

    // Connect to database
    $db = new dbManager();
    $db->openConnection();

    // Validate uploaded file type
    if(!is_valid_file($_FILES['csv-file']['name'])) {
        echo "Uploaded file type invalid";
        exit();
    }
    // Upload CSV file
    $csv_file = file($_FILES['csv-file']['tmp_name']);
    // Transform file into 2D array
    $csv_array = array_map('str_getcsv', $csv_file);

    // Parse 2D array for transaction data
    for ($i = 1; $i < count($csv_array); $i++) {
        
        // Parse row for single transaction 
        $account = validate_input($db, $csv_array[$i][0]);
        $date = validate_input($db, $csv_array[$i][1]);
        $amount = validate_input($db, $csv_array[$i][2]);
        $merchant = validate_input($db, $csv_array[$i][3]);

        if(!is_valid_transaction($account, $date, $amount, $merchant)) {
            echo "Uploaded transaction is invalid.";
            continue;
        }

        file_put_contents('php://stderr', print_r('0', TRUE));

        // Create new Transaction object
        $transaction = new Transaction($account, $date, $amount, $merchant);

        // Add transaction to User
        // $user.addTransaction($transaction);
        
        // Log transaction 
        $log = "INSERT INTO transactions (user, account, date, amount, merchant)
                VALUES ('$email', '$account', '$date', '$amount', '$merchant')";
        $db->queryRequest($log);
        
    }

    $db->closeConnection();
    header('../../dashboard.php');
}
?>