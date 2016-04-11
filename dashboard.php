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
				$newAccount = new Account($_POST["accountName"], $_POST['accountTypeInput']);

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
												Name
											</th>
											<th style="width:200px">
												Type
											</th>
											<th style="width:70px">
												<i class="fa fa-hashtag"></i>

											</th>
											<th style="width:70px">
												<i class="fa fa-usd"></i>

											</th>
											<th style="width:10px">
												<i class="fa fa-line-chart"></i>

											</th>

										</tr>
									</tbody>
								</table>
								</div>
							</div>
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
												Account Type
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

										    foreach ($accountsArray as $key => $value)
										    {
										        echo'<tr>'; 
										        echo'<td>' . $value->getName() . "</td>";
										        echo'<td>' . $value->getType() . "</td>";
										        echo'<td> 
										        		<form action="" method="post">
										        			<input type="radio" name="display" unchecked>
										        		</form>
										        	</td>';
										        echo'<td> 
										        		<form action="" method="post">
										        			<input type="button" name="removeAccount"
										        				value="Remove" id="removeAccount">
										        		</form>
										        	</td>';
										        echo'<tr>';
										    }
										?>

									</tbody>
								</table>
								</div>
							</div>


							<form action="" method="post">
								Account Name:<br>
								<input type="text" name="accountName" id="accountName"><br>
								Account Type:<br>
								<select name="accountTypeInput">
									<option value="savings">Savings</option>
									<option value="credit">Credit</option>
									<option value="loan">Loan</option>
								</select>

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
