<?php

	//TODO:
	//	potentially include account and transaction classes as member objects
	//	user will have these and then we will store the individual elements in the database upon logout


	//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    //REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

	class User
	{

		private $email;
		private $encryptedPassword;

		function __construct($email,$encryptedPassword) {
			$this->email = $email;
			$this->encryptedPassword = $encryptedPassword;
		}

		private function setEncryptedPassword($password){
			$this->encryptedPassword = $password;
		}

		private function getEncryptedPassword()
		{
			return $this->encryptedPassword;
		}
		public function getEmail()
		{
			return $this->email;
		}

	}

?>


