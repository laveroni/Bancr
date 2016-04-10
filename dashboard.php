<?php
	
//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
//REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

require_once("scripts/Transaction/transaction.php");
require_once("scripts/account/account.php");
require_once("scripts/db/db_manager.php");
require_once("scripts/UserClass/User.php");

session_start();

if($_SESSION['loggedIn'] == false || $_SESSION['loggedIn'] == null)
{	
	header('Location: ./index.php');
	exit();
}

if(!isset($_SESSION['email']) || !isset($_SESSION['password'])) 
{
	header('Location: ./index.php');
	exit();
}

// file_put_contents('php://stderr', print_r("HERE", TRUE));

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
	$amount = $row['amount'];
	$merchant = $row['merchant'];

	// Add transaction data to user
    $user->addTransaction($account, $date, $amount, $merchant);

    $transactions_json[] = array('account' => $account, 'date' => $date, 'amount' => $amount, 'merchant' => $merchant);
}

$db->closeConnection();
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
		<script src="./vendors/chart.min.js"></script>
		<script src="./vendors/Chart.Scatter.min.js"></script>
		
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
							<h4>Import .csv File</h4>
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
						<td  style="height:480px; width:25%; background-color: white; padding-top:0px;">
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
									
							</div>
								
						</td>

						<!-- Graph -->
						<td class="graphTD" >
							<div id="gContainer">
		                    	<canvas id="graph" width = 500 height = 300>></canvas>
		                    </div>		
						</td>

						<!-- Account list -->
						<td style="width:25%; text-align:center ">
							<div style="">
							<h2 style="padding-bottom:10px; margin-top:0px; text-align:center; vertical-align:middle">Accounts</h2>
							<div id='accounts' name='accounts' style="overflow-y: scroll; max-height: 321px">
								
								<table style="margin-bottom:0px" class="table table-striped table-hover table-bordered table-responsive  portfolioWidget">
									<tbody>
										<tr>
											<th style="width:90px">
												Account Name
											</th>
											<th style="width:90px">
												Balance
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
											$accountsArray = $user->getAccountsArray();

										    foreach ($accountsArray as $key => $value)
										    {
										        echo'<tr>'; 
										        echo'<td>' . $value->getName() . "</td>";
										        echo'<td>' . $value->getBalance() . "</td>";
										        echo'<td> 
										        		<form action="" method="post" name="af" id="af">
										        			<input type="checkbox" onclick="updateGraph();" name="display[]" id=' . $value->getName() . ' unchecked>
										        		</form>
										        	</td>';
										        echo'<td> 
										        		<form action="" method="post">
										        			<input type="button" name="removeAccount" value="Remove" id="removeAccount">
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
				
				</tbody>

		</table>
	<script type='text/javascript'>

		function updateGraph(cb) {
			// Get selected account names
			var selected = [];
		    $('#accounts input:checked').each(function() {
		        selected.push($(this).attr('id'));
		    });

		    // Convert user transactions to js
			var transactions = <?php echo json_encode($transactions_json); ?>;
			//console.log(transactions);

			// Get relevant transaction data
			var data = [];
			for(i = 0; i < selected.length; i++) 
			{
				var account = selected[i];
				var balance = 0;

				var data_set = {
					label: account,
				    strokeColor: '#F16220',
				    pointColor: '#F16220',
				    pointStrokeColor: '#fff',
				    data: []
				};

				for(j = 0; j < transactions.length; j++)
				{
					if(account == transactions[j]['account']) 
					{
						var date = transactions[j]['date'];
						balance += transactions[j]['amount'];

						var point = {
							x: date,
						    y: balance,
						};

						data_set.data.push(point);
					}
				}

				data.push(data_set);
			}

			console.log(data);

		  	var options = {
		    	scaleType: "date",
		    	scaleDateFormat: "m d yyyy"
		  	};


			var ctx = document.getElementById("graph").getContext("2d");
			new Chart(ctx).Scatter(data, options);
		}

	</script>

	</body>
</html>