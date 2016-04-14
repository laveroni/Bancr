<!-- if not logged in, redirect to log in page -->
<?php
	
	//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    //REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

	

	include_once("scripts/UserClass/User.php");
	include_once("scripts/account/account.php");

	session_start();

	if(!isset($_SESSION['addAccountError']))
	{
		$_SESSION['addAccountError'] = "";
	}

	if(!isset($_SESSION['addTransactionError']))
	{
		$_SESSION['addTransactionError'] = "";
	}

	if($_SESSION['loggedIn'] == false || $_SESSION['loggedIn'] == null)
	{	
		header('Location: ./index.php');
		exit();
	}

	if(isset($_POST['addAccount']))
	{
		
		if(isset($_POST["accountName"]) && $_POST["accountName"] != "")
		{
			$_SESSION['addAccountError'] = "";


			$testAccounts = $_SESSION['userObject']->getAccountsArray();

			foreach ($testAccounts as $key => $value)
			{ 
				if($value->getName() == $_POST["accountName"])
				{
					$_SESSION['addAccountError'] = "<br>Error: Account Name Already Exists";
					break;
				}
				
			}	

			if($_SESSION['addAccountError'] == "")
			{
				$newAccount = new Account($_POST["accountName"], $_SESSION['userObject']->getNumAccounts());

				$_SESSION['userObject']->addAccount($newAccount);


				//$testAccounts = $_SESSION['userObject']->getAccountsArray();

				// foreach ($testAccounts as $key => $value)
				// {
				// 	echo'<br>'; 
				// 	echo $key . "   " . $value->getName();
				// 	echo'<br>';
				// }	
				// exit();	

				header("Location: dashboard.php");
				exit();
			}

		}

		else
		{
			$_SESSION['addAccountError'] = "<br>Error: Enter Account Name";
		}

		
	}



//fix below for transaction


	if(isset($_POST['addTransaction']))
	{
		
		if(isset($_POST["transactionName"]) && $_POST["transactionName"] != "" && isset($_POST["transactionAmount"]) && $_POST["transactionAmount"] != "" && isset($_POST["transactionMerchant"]) && $_POST["transactionMerchant"] != "" && isset($_POST["transactionDate"]) && $_POST["transactionDate"] != "")
		{
			$_SESSION['addTransactionError'] = "";


			$transAccounts = $_SESSION['userObject']->getAccountsArray();

			$arrayKey = 0;

			foreach ($transAccounts as $key => $value)
			{ 
				if($value->getName() == $_POST["transactionName"])
				{
					$arrayKey = $key;
				}
				
			}


			$_SESSION['userObject']->addTransaction($_POST["transactionDate"], $_POST["transactionAmount"], $_POST["transactionName"], $_POST["transactionMerchant"], $arrayKey);


			header("Location: dashboard.php");
			exit();
			
		}

		else
		{
			$_SESSION['addTransactionError'] = "<br>Error: Invalid Parameters";
		}

		
	}








	if (isset($_POST['removeAccount'])) 
	{
  		$accountsArray = $_SESSION['userObject']->getAccountsArray();

		$newAccountObject = $accountsArray[$_POST['id']];

		$_SESSION['userObject']->removeAccount($newAccountObject);

		header("Location: dashboard.php");
		exit();
	}

?>

<html>
	<head>
	    <script src="./vendors/jquery-1.12.1.min.js"></script>
	    <script src="./vendors/moment.js"></script>
	    <script src="./vendors/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="./vendors/bootstrap-3.3.6-dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./styles/portfolio.css">
        <link rel="stylesheet" type="text/css" href="./styles/styles.css">
        <link rel="stylesheet" href="./vendors/font-awesome-4.5.0/css/font-awesome.min.css">
        <script src="https://code.highcharts.com/stock/highstock.js"></script>
		<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>

	</head>

	<body style="margin:30px;">

		
		<table class ="portfolioPage" style=" border-collapse: separate; border-spacing: 15px;">
			<thead>
			</thead>
				<tbody>
					<!-- Top -->
					<tr>
						<!-- Import csv -->
						<td style ="width: 100px; height: 80px; text-align:center">
							<h2 style="padding-bottom:10px; margin-top:0px; text-align:center; vertical-align:middle">Import CSV</h2>
							<form id="csv-form" action="scripts/uploadCSV/uploadCSV.php" method="post" enctype="multipart/form-data">
							    <input id='csv-file' type='file' name='csv-file' accept='.csv,.CSV'>
							    <input type='submit' value='upload' name='submit'>
							</form>
						</td>

						<!-- Search -->
						<td style="width:50%;     text-align: -webkit-center;">
							<h2 style="padding-bottom:10px; margin-top:0px; text-align:center; vertical-align:middle">Bancr</h2>
							<!--<div>
							    <div class="input-group" style="width: 60%;border-collapse: collapse;">
							    	<form action='' method='post'>
									    <input name="searchQuery" type="text" class="form-control" id="stockSearch" placeholder="Search for...">
									    <span class="input-group-btn">
							        		<button type="submit" id="addToWatchList" name="addToWatchList" class="btn btn-default"> Add to Watchlist</button>
							        	</span>
							        </form>
							-->
							   		
							      
							    </div><!-- /input-group -->
							  </div><!-- /.col-lg-6 -->
						</td>

						<!-- Date, User Manual, Logout -->
						<td style="width:25%; text-align:center ">
							<div class="timeDisplay"></div>
							<div class="dateDisplay"></div>
						
							<button name="logout" id="logout" value="logout" type="submit" style="width:100px;" class="btn btn-default" onclick="window.location.href='scripts/logout/logout.php'">
							Logout
							</button>
						
							


						</td>
					</tr>

					<!-- Middle -->
					<tr>
						<!-- Transactions -->
						<td  style="height:480px; width:30%; background-color: white; padding-top:0px;">
							<div style="">
							<h2 style="padding-bottom:10px; margin-top:0px; text-align:center; vertical-align:middle">Transactions</h2>
							<div style="overflow-y: scroll; max-height: 321px">
								
								<table style="margin-bottom:0px" class="table table-striped table-hover table-bordered table-responsive  portfolioWidget">
									<tbody>
										<tr>
											<th style="width: 90px">
												Account
											</th>
											<th style="width:200px">
												<i class="fa fa-usd"></i>
											</th>
											<th style="width:70px">
												Merchant
											</th>
											<th style="width:70px">
												Date
											</th>

										</tr>


										<?php 
											$accountsArray = $_SESSION['userObject']->getAccountsArray();


											function cmpTrans($a, $b)
											{
											    return strcmp($a->getName(), $b->getName());
											}

											usort($accountsArray, "cmpTrans");


										    foreach ($accountsArray as $key => $value)
										    {

										    	$accountTransactionHistory = $value->getHistory();

										    	foreach ($accountTransactionHistory as $transVal)
										    	{
										    		echo'<tr>'; 
										        	echo'<td>' . $transVal->getAccount() . '</td>';
										        	echo'<td>' . $transVal->getAmount() . '</td>';
										        	echo'<td>' . $transVal->getMerchant() . '</td>';
										        	echo'<td>' . $transVal->getDate() . '</td>';
										        	echo'</tr>';
										    	}

										    }
										?>


									</tbody>
								</table>
								</div>
							</div>


							<form action="" method="post">
								Transaction Acccount:<br>
								<input type="text" name="transactionName" id="transactionName"><br>
								<!-- Account Type:<br>
								<select name="accountTypeInput">
									<option value="savings">Savings</option>
									<option value="credit">Credit</option>
									<option value="loan">Loan</option>
								</select> -->

								Transaction Amount:<br>
								<input type="text" name="transactionAmount" id="transactionAmount"><br>
								Transaction Merchant:<br>
								<input type="text" name="transactionMerchant" id="transactionMerchant"><br>
								Transaction Date:<br>
								<input type="text" name="transactionDate" id="transactionDate"><br>

								<?php echo '<div style="color:red;">' . $_SESSION['addTransactionError'] . '</div>'; ?>
								<div style="margin-top: 15px">
									<button name="addTransaction" type="submit" style="width:140px;" class="btn btn-default" id="addTransaction">Add Transaction</button>
								</div>
							</form>



							<div style=" background-color:white">
									<!-- Stock info
									
								-->
							</div>
								
						</td>

						<!-- Graph -->

						<td class="graphTD" >
							<h2 style="padding-bottom:10px; margin-top:0px; text-align:center; vertical-align:middle">Graph</h2>
							<!-- Nav tabs -->
							<!--<ul class="nav nav-tabs" role="tablist" >
								<li role="presentation" class="active" style="width:50%; text-align:center"><a href="#portfolioGraph" aria-controls="portfolioGraph" role="tab" data-toggle="tab">Portfolio</a>
								</li>
								<li role="presentation"  style="width:50%; text-align:center"><a href="#watchlistGraph" aria-controls="watchlistGraph" role="tab" data-toggle="tab">Watchlist</a>
								</li>
							</ul>-->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="portfolioGraph"></div>
								<!--<div role="tabpanel" class="tab-pane" id="whatlistGraph"></div>-->
						</td>

						<!-- Account list -->
						<td style="width:25%; text-align:center ">
							<div style="">
							<h2 style="padding-bottom:10px; margin-top:0px; text-align:center; vertical-align:middle">Accounts</h2>
							<div style="overflow-y: scroll; max-height: 321px">
								
								<table style="margin-bottom:0px" class="table table-striped table-hover table-bordered table-responsive  portfolioWidget">
									<tbody>
										<tr>
											<th style="width:90px">
												Account Name
											</th>
											<th style="width:90px">
												Balance ($)
											</th>
											<th style="width:10px">
												Display
												<i class="fa fa-line-chart"></i>
											</th>
											<th style="width:40px">
												Action
											</th>

										</tr>

										<?php 
											$accountsArray = $_SESSION['userObject']->getAccountsArray();


											function cmp($a, $b)
											{
											    return strcmp($a->getName(), $b->getName());
											}

											usort($accountsArray, "cmp");


										    foreach ($accountsArray as $key => $value)
										    {
										        echo'<tr>'; 
										        echo'<td>' . $value->getName() . '</td>';
										        echo'<td>' . $value->getBalance() . '</td>';
										        echo'<td> 
										        		<form action="" method="post">
										        			<input type="radio" name="display" unchecked>
										        		</form>
										        	</td>';

										        if($value->getNumber() >= 0 && $value->getNumber() <= 2)
										        {
										        	echo '<td></td>';
										        }
										        else
										        {
										        	echo'<td>' . 
										        		'<form action="" method="post">' . 
										        			'<input type="submit" name="removeAccount" value="Remove" id="removeAccount">' . 
										        			'<input type="hidden" name="id" value="' . $value->getNumber() . '" />' . 
										        		'</form>' . 
										        	'</td>';
										        }
										        
										        echo'</tr>';
										    }
										?>

									</tbody>
								</table>
								</div>
							</div>


							<form action="" method="post">
								Account Name:<br>
								<input type="text" name="accountName" id="accountName"><br>
								<!-- Account Type:<br>
								<select name="accountTypeInput">
									<option value="savings">Savings</option>
									<option value="credit">Credit</option>
									<option value="loan">Loan</option>
								</select> -->

								<?php echo '<div style="color:red;">' . $_SESSION['addAccountError'] . '</div>'; ?>
								<div style="margin-top: 15px">
									<button name="addAccount" type="submit" style="width:100px;" class="btn btn-default" id="addAccount">Add account</button>
								</div>
							</form>

						</td>
						</tr>
						
						<!-- bottom -->
						<tr>
						<!-- Budget -->
						<td  style="height:480px; width:30%; background-color: white; padding-top:0px;">
							<div style="">
							<h2 style="padding-bottom:10px; margin-top:0px; text-align:center; vertical-align:bottom">Budget</h2>
							<form action="" method="post">
								Budget Type:
								<select name="budgetType" id="budgetType">
									<option value="Food">Food</option>
									<option value="Transportation">Transportation</option>
									<option value="Clothes">Clothes</option>
								</select><br>
								Budget:
								<input type="text" name="budget" id="budget">
								<input type="button" value="submit" name="budgetSubmission" id="budgetSubmission">
							</form>
							<table border="1">
								<tr>
									<td>Budget type</td>
									<td>Budget</td>
									<td>Already used</td>
									<td>Fund left</td>
								</tr>
								<tr>
									<td>Food</td>
									<td>100</td>
									<td>20</td>
									<td>80</td>
								</tr>
							</div>
							<div style=" background-color:white">
									<!-- Stock info
									
								-->
							</div>
								
						</td>


					</tr>
				
				</tbody>

		</table>


	</body>

</html>

