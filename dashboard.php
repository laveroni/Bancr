<!-- if not logged in, redirect to log in page -->
<?php
	
	//REMOVE BELOW UPON SUCCESSFUL IMPLEMENTATION
    ini_set('display_errors', 'On');
    error_reporting(E_ALL | E_STRICT);
    //REMOVE ABOVE UPON SUCCESSFUL IMPLEMENTATION

	

	include_once("scripts/UserClass/User.php");
	include_once("scripts/account/account.php");

	session_start();


	if($_SESSION['loggedIn'] == false || $_SESSION['loggedIn'] == null)
	{	
		header('Location: ./index.php');
		exit();
	}

	if(isset($_POST['addAccount']))
	{
		$newAccount = new Account($_POST["accountName"]);

		$_SESSION['userObject']->addAccount($newAccount);


		$testAccounts = $_SESSION['userObject']->getAccountsArray();

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
							
							<button name="logout" id="logout" type="submit" style="width:100px;" class="btn btn-default" onclick="window.location.href='scripts/logout/logout.php'">
							Logout
							</button>
							
							


						</td>
					</tr>

					<!-- Middle -->
					<tr>
						<!-- Portfolio of seven stocks -->
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
											<th style="width:10px">
												<i class="fa fa-line-chart"></i>
											</th>
											<th style="width:90px">
												Action
											</th>

										</tr>

										<?php 
											$accountsArray = $_SESSION['userObject']->getAccountsArray();

										    foreach ($accountsArray as $key => $value)
										    {
										        echo'<tr>'; 
										        echo'<td>' . $value->getName() . "</td>";
										        echo'<td> 
										        		<form action="" method="post">
										        			<input type="radio" name="display" unchecked>
										        		</form>
										        	</td>';
										        echo'<td> 
										        		<form action="" method="post">
										        			<input type="button" name="removeAccount"
										        				value="remove account">
										        		</form>
										        	</td>';
										        echo'<tr>';
										    }
										?>

									</tbody>
								</table>
								</div>
							</div>

							<!--Error: Enter Account Name-->

							<form action="" method="post">
								Account Name:<br>
								<input type="text" name="accountName" id="accountName"><br>
								<div style="margin-top: 15px">
									<button name="addAccount" type="submit" style="width:100px;" class="btn btn-default" id="addAccount">Add account</button>
								</div>
							</form>


						</td>


					</tr>
				
				</tbody>

		</table>


	</body>

</html>
