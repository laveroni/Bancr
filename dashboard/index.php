<?php require 'dashboard.php' ?>
<html>
	<head>
        <link rel="stylesheet" type="text/css" href="../vendors/bootstrap-3.3.6-dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../styles/portfolio.css">
        <link rel="stylesheet" type="text/css" href="../styles/styles.css">
        <link rel="stylesheet" href="../vendors/font-awesome-4.5.0/css/font-awesome.min.css">
        <script src="../vendors/jquery-1.12.1.min.js"></script>
	    <script src="../vendors/moment.js"></script>
	    <script src="../vendors/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
		<script src="../vendors/chart.min.js"></script>
		<script src="../vendors/Chart.Scatter.min.js"></script>
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
							<form id="csv-form" action="../scripts/uploadCSV.php" method="post" enctype="multipart/form-data">
							    <input id='csv-file' type='file' name='csv-file' accept='.csv,.CSV'>
							    <input type='submit' value='upload' name='submit'>
							</form>
						</td>

						<!-- Title -->
						<td style="width:50%; text-align: -webkit-center;">
							<h2 style="padding-bottom:10px; margin-top:0px; text-align:center; vertical-align:middle">Bancr</h2>
							    </div>
							  </div>
						</td>

						<!-- Date, User Manual, Logout -->
						<td style="width:25%; text-align:center ">
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
						<td style="height:480px; width:25%; background-color: white; padding-top:0px;">
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
											$accounts = $user->getAccountsArray();
										    foreach ($accounts as $key => $value)
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
								<div style="margin-top: 15px">
									<button name="addAccount" type="submit" style="width:100px;" class="btn btn-default" id="addAccount">Add account</button>
								</div>
							</form>
						</td>
					</tr>
				</tbody>
		</table>
		<?php require 'graph.php' ?>
	</body>
</html>