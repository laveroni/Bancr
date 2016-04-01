<?php

	//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    //REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

	class Account
	{
		private $date;
		private $amount; 
		private $type;  //e.g., credit cards, savings, loans
		private $merchant;


		function __construct ($data, $amount, $type, $merchant)
		{
			$this->date = $data;
			$this->amount = $amount;
			$this->type = $type;
			$this->merchant = $merchant;
		}

		private function setDate($date)
		{
			$this->date = $date;
		}

		private function setAmount($amount)
		{
			$this->amount = $amount;
		}

		private function setType($type)
		{
			$this->type = $type;
		}

		private function setMerchant($merchant)
		{
			$this->merchant = $merchant;
		}

		public function getDate()
		{
			return $this->date;
		}

		public function getAmount()
		{
			return $this->amount;
		}

		public function getType()
		{
			return $this->type;
		}

		public function getMerchant()
		{
			return $this->merchant;
		}

	}

?>