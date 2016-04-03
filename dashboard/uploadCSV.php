<?php

/*
<button id='csv' class='tool button' title='CSV Upload'>
    <span class="glyphicon glyphicon-open-file" aria-hidden="true"></span>
</button>
                
<form id="csv-form" action="/uploadCSV.php" method="post" enctype="multipart/form-data">
    <input id='csv-file' type='file' name='csv-file'>
    <input type='submit' value='upload' name='submit'>
</form>
*/

require_once('../db/db_manager.php');
require_once('../UserClass/User.php');
require_once('../Transaction/transaction.php');

function validate_input($db, $data) 
{
    $data = trim($data);
    //$data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($db->getCon(), $data);
    return $data;
}

function is_valid_file($filename) {
    $ext = strtolower(end(explode('.', $filename)));
    if($ext != "csv") {
        return false;
    } else {
        return true;
    }
}

function is_valid_transaction($account, $date, $amount, $merchant) {

    // Check whether fields are empty
    if( empty($account) || empty($date) || empty($amount) || empty($merchant)) {
        return false;
    }
    // Check whether date valid
    $transaction_date = date_create_from_format("n/j/Y", $date);
    $current_date = date("n/j/Y");
    if($transaction_date > $current_date) {
        return false;
    }
    // Other error checks?
    return true;
}

session_start();

// CSV Functionality
if(isset($_POST['submit'])) {

    //REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    //REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

    if (!isset($_SESSION['user']) || !isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'])
    {
        header('Location: ../index.html');
        exit();
    }

    $user = $_SESSION['userObject'];
    $email = $user.getEmail();
    // OR, $email = $user['email'];

    // Connect to database
    $db = new dbManager();
    $db->openConnection();

    // Get userID from database
    $query = "SELECT * FROM Users WHERE Email = '$email' ";
    $result = $db->queryRequest($query);
    $row = mysqli_fetch_row($result);
    $userID = $row[0];

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

        // Create new Transaction object
        $transaction = new Transaction($account, $date, $amount, $merchant);

        // Add transaction to User
        // $user.addTransaction($transaction);

        // CAN BE DONE IN addTransaction() ?
        // Log transaction to database
        $log = "INSERT INTO Transactions (user, account, date, amount, merchant)
                VALUES ('$userID', '$account', '$date', '$amount', '$merchant')";
        $db->queryRequest($log);
        // CAN BE DONE IN addTransaction() ?
    }

    $db->closeConnection();
}
?>