<?php require 'dashboard.php' ?>


<html>
	<head>
        <link rel="stylesheet" type="text/css" href="../vendors/bootstrap-3.3.6-dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../styles/portfolio.css">
        <link rel="stylesheet" type="text/css" href="../styles/styles.css">
        <link rel="stylesheet" href="../vendors/font-awesome-4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../vendors/jquery-ui-1.11.4.custom/jquery-ui.css">
        <script src="../vendors/jquery-1.12.1.min.js"></script>
	    <script src="../vendors/moment.js"></script>
	    <script src="../vendors/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
		<script src="../vendors/chart.min.js"></script>
		<script src="../vendors/Chart.Scatter.min.js"></script>
      	<script src="../vendors/jquery-ui-1.11.4.custom/jquery-ui.js"></script>

		<script type="text/javascript">
			var timer;
			var stoppedElement=document.getElementById("stopped");   

			function mouseStopped()
			{                                 
    			<?php
    				//when the mouse stops moving, serialize object and put in database.
					//This prevents loss of data on inactivity or window close, but when the logout button isnt clicked

    				$email = $_SESSION['email']; 
    				$user = $_SESSION['userObject'];

    				$serial = serialize($user);
    				$encodedObject = base64_encode($serial);

    				//create a db class object, open connection
    				$db = new dbManager();
    				$db->openConnection();

    				$query = "UPDATE Users SET UserObject = '$encodedObject' WHERE Email = '$email'";
    				$result = $db->queryRequest($query);
    
    				$db->closeConnection();
    			?>
			}

			window.addEventListener("mousemove",function()
			{
    			clearTimeout(timer);
    			timer=setTimeout(mouseStopped,300);
			});

			$(function () 
			{   
			    $('#from_date_text, #to_date_text').datepicker ({
				    dateFormat: "mm/dd/yy"
			    });
			});
			
		</script>

	</head>

	<body style="margin:30px;background-color:333333;">
		<table class ="portfolioPage" style=" border-collapse: separate; border-spacing: 15px;">
			<thead>
			</thead>
				<tbody>
					<!-- Top -->
					<tr>
						<!-- Import csv -->
						<td style ="width: 100px; height: 80px; text-align:center; background-color:d3d3d3;">
							<h4>Import .csv File</h4>
							<form id="csv-form" action="../scripts/uploadCSV.php" method="post" enctype="multipart/form-data">
							    <input id='csv-file' type='file' name='csv-file' accept='.csv,.CSV'>
							    <input type='submit' value='upload' name='submit'>
							</form>
						</td>

						<!-- Title -->
						<td style="width:50%; text-align: -webkit-center; background-color:d3d3d3;" >
							<h2 style="padding-bottom:10px; margin-top:0px; text-align:center; vertical-align:middle">Bancr</h2>
							    </div>
							  </div>
						</td>

						<!-- Date, User Manual, Logout -->
						<td style="width:25%; text-align:center;  background-color:d3d3d3;">
							<div class="timeDisplay"></div>
							<div class="dateDisplay"></div>
							<button name="logout" id="logout" value="logout" type="submit" style="width:100px;" class="btn btn-default" onclick="window.location.href='../scripts/logout.php'">
							Logout
							</button>
						</td>
					</tr>

					<!-- Middle -->
					<tr>
						<!-- Transactions -->
						<td style="height:480px; width:25%; background-color: white; padding-top:0px; background-color:d3d3d3;">
							<div style="">
							<h2 style="padding-bottom:10px; margin-top:0px; text-align:center; vertical-align:middle">Transactions</h2>
							<div style="overflow-y: scroll; max-height: 321px">
								
								<table style="margin-bottom:0px; " class="table table-striped table-hover table-bordered table-responsive  portfolioWidget">
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
										    	if($value->getNumber() == 0 || $value->getNumber() == 1 || $value->getNumber() == 2)
										    	{
										    		// $accountTransactionHistory = $value->getHistory();
										    		// foreach ($accountTransactionHistory as $transVal)
										    		// {
										    		// 	echo'<tr>'; 
										      //   		echo'<td>' . $transVal->getAccount() . '</td>';
										      //   		echo'<td>' . $transVal->getAmount() . '</td>';
										      //   		echo'<td>' . $transVal->getMerchant() . '</td>';
										      //   		echo'<td>' . $transVal->getDate() . '</td>';
										      //   		echo'</tr>';
										    		// }
										    	}
										    	else
										    	{
										    		$accountTransactionHistory = $value->getHistory();
										    		foreach ($accountTransactionHistory as $transVal)
										    		{
										    			echo'<tr class="' . $value->getNumber() . '">'; 
										        		echo'<td>' . $transVal->getAccount() . '</td>';
										        		echo'<td>' . $transVal->getAmount() . '</td>';
										        		echo'<td>' . $transVal->getMerchant() . '</td>';
										        		echo'<td>' . $transVal->getDate() . '</td>';
										        		echo'</tr>';
										    		}
										    	}
										    }
										?>
									</tbody>
								</table>
								</div>
							</div>


							<!-- <form action="" method="post">
								Transaction Account:<br>
								<input type="text" name="transactionName" id="transactionName"><br>

								Transaction Amount:<br>
								<input type="text" name="transactionAmount" id="transactionAmount"><br>
								Transaction Merchant:<br>
								<input type="text" name="transactionMerchant" id="transactionMerchant"><br>
								Transaction Date:<br>
								<input type="text" name="transactionDate" id="transactionDate"><br>

								<div style="margin-top: 15px">
									<button name="addTransaction" type="submit" style="width:140px;" class="btn btn-default" id="addTransaction">Add Transaction</button>
								</div>
							</form> -->


							<div style=" background-color:white">	
							</div>
						</td>

						<!-- Graph -->
						<td class="graphTD" style="background-color:d3d3d3;">
							<div id="gContainer" style="max-width:500px; min-width: 500px; max-height:300px; min-height:300px;">
		                    	<canvas id="graph" width="500px" height="300px" style="max-width:500px; max-height:300px; min-height:300px; position:absolute;"></canvas>
		                    </div>		
		                    <div style="text-align:center;"> 
			                    From: <input type="text" id="from_date_text" name="from_date_text" size="11" placeholder="mm/dd/yyyy">
			                    To: <input type="text" id="to_date_text" name="to_date_text" size="11" placeholder="mm/dd/yyyy">
			                    <button type="submit" id="range_button" name="range_button" onclick="updateGraph()"class="btn btn-default">Update</button>
		                    </div>
						</td>

						<!-- Account list -->
						<td style="width:25%; text-align:center; background-color:d3d3d3 ">
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
											$accountsArray = $_SESSION['userObject']->getAccountsArray();
											function cmp($a, $b)
											{
											    return strcmp($a->getName(), $b->getName());
											}
											usort($accountsArray, "cmp");
										    foreach ($accountsArray as $key => $value)
										    {
										        if($value->getNumber() >= 0 && $value->getNumber() <= 2)
										        {
										        	echo 
											        '<tr> 
										        	<td id="superRow">' . $value->getName() . '</td>
										        	<td>' . $value->getBalance() . '</td> 
										        	<td> 
										        		<form action="" method="post" name="af" id="af">
										        			<input type="checkbox" onclick="updateGraph()" name="display[]" id=' . $value->getNumber() . ' checked>
										        		</form>
										        	</td>
										        	<td></td>
										        	</tr>';
										        }
										        else
										        {
										        	echo
										        	'<tr> 
										        	<td id="superRow">' . $value->getName() . '</td>
										        	<td>' . $value->getBalance() . '</td> 
										        	<td> 
										        		<form action="" method="post" name="af" id="af">
										        			<input type="checkbox" onclick="updateGraph()" name="display[]" id=' . $value->getNumber() . ' unchecked>
										        		</form>
										        	</td>
										        	<td> 
										        		<form action="" method="post"> 
										        			<input type="submit" name="removeAccount" value="Remove" id="removeAccount"> 
										        			<input type="hidden" name="id" value="' . $value->getNumber() . '" /> 
										        		</form> 
										        	</td>
										        	</tr>';
										        }

										    }
										?>

									</tbody>
								</table>
								</div>
							</div>
							<form action="" method="post">
								<br>Account Name:<br>
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
						<td style ="width: 100px; height: 80px; text-align:center; background-color:d3d3d3;">
							<h2 style="padding-bottom:10px; margin-top:0px; text-align:center; vertical-align:middle">Budget</h2>
							Select a Budget Category:<br>
								<select name="category" id="category">
									<option value="Food" name="Food" id="Food">Food</option>
									<option value="Clothes" name="Clothes" id="Clothes">Clothes</option>
									<option value="Transportation" name="Transportation" id="transportation">Transportation</option>
								</select>
								
								<br><br>Select a Month:<br>
								<select name="month" id="month" size="1">
    								<option value="01">January</option>
    								<option value="02">February</option>
    								<option value="03">March</option>
    								<option value="04">April</option>
    								<option value="05">May</option>
    								<option value="06">June</option>
    								<option value="07">July</option>
    								<option value="08">August</option>
    								<option value="09">September</option>
    								<option value="10">October</option>
    								<option value="11">November</option>
    								<option value="12">December</option>
								</select>
								<br><br>Set a Budget Limit:<br>
								<input type="number" name="budget" id="budget" min="0" max="1000000">

								<input type="button" name="budgetButton" id="budgetButton" value="Submit" onclick=updateBudget()>
								<br><br>
								<table border="1">
								<tr>
									<th style="width:100px">
									Budget Category
									</th>
									<th style="width:100px">
									Budget
									</th>
									<th style="width:100px">
									Balance
									</th>
								</tr>
								<tr>
									<td>
									food
									</td>
									<td>
									300
									</td>
									<td>
									250
									</td>
								</tr>
								</table>
							</form>
						</td>
					</tr>
				</tbody>
		</table>
		<?php require 'graph.php' ?>
	</body>
</html>
