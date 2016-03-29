<?php
	
	//assuming that when this class and it's methods are called, that loggedIn session variable
	//is already checked to ensure a user is logged in

class dbManager {

	private $db_host;
	private $db_username;
	private $db_password; 
	private $db_database;
	private $db_conn;

	public function __construct()
	{
		$this->setVars();
	}

	//making this class automatically
	private function setVars() //$host, $user, $pass, $database
	{
		//TODO: Fill in variables with actual values

		$this->db_host = "localhost";
		$this->db_username = "root";
		$this->db_password = "password";
		$this->db_database = "CSCI310";
	}

	public function openConnection()
	{
		// connect to database with variables included with db.php file
    	//if connection fails (or die) then it outputs and terminates
		$this->db_conn = mysqli_connect($this->db_host,$this->db_username,$this->db_password, $this->db_database)
   		or die('Error connecting to MySQL server.');

   		//make sure it connected, if there is an error it can display
    	if (mysqli_connect_error()) 
    	{
   		    die("Database connection failed: " . mysqli_connect_error());
   		}

	}

	public function queryRequest($command)
	{
		//command is a variable holding the database command to locate user based on name and password

    	//actually query the database with the given command
    	$result_login = mysqli_query($this->db_conn, $command);

    	//returns the rows returned from the query
    	return $result_login;
	}

	public function closeConnection()
	{
		mysqli_close($this->db_conn);
	}

	public function getCon()
	{
		return $this->db_conn;
	}
}


//	TODO:
//		hard code database values in setVals();

?>
