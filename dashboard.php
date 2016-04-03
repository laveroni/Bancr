<html>
	<head>
	    <script src="./vendors/jquery-1.12.1.min.js"></script>
	    <script src="./vendors/moment.js"></script>
	    <script src="script.js"></script>
	    <script src="graph.js"></script>
	    <script src="./vendors/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="./vendors/bootstrap-3.3.6-dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./styles/portfolio.css">
        <link rel="stylesheet" type="text/css" href="./styles/styles.css">
        <link rel="stylesheet" href="./vendors/font-awesome-4.5.0/css/font-awesome.min.css">
        <script src="https://code.highcharts.com/stock/highstock.js"></script>
		<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>

	</head>

	<body style="margin:30px;">

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" style="text-align:center" id="myModalLabel">User Manual</h4>
		      	</div>
		      		<div class="modal-body">
		     			<p>
		     				<span style="font-size:20px">Welcome to Trading!</span>
		     				<br><br> 
		    				<b>Search</b>
		      				<br>
							<span>Enter a company name or ticker name to browse through available stocks. Click "Add to Watchlist" to add the stock to your Watchlist and see its information and it plotted on the graph.</span>
							<br><br>
							<b>Import .csv File</b>
							<br>
							<span>Click "Browse" to search through your files to import a .csv formatted file. The file will be in this format:<span>
							<br>
							<p>
								STOCK_TICKER_NAME, DATE_BOUGHT_DOLLARS, PRICE_BOUGHT, NUMBER_OF_SHARES
								<br>
								NFLX, 11/2/2015, 108.92, 10
								<br>
								CMG, 2/27/2016, 505.79, 25
								<br>
								COST, 2/4/2016, 143.28, 90
								<br>
								EBAY, 1/5/2013, 26.12, 20
								<br>
								GLD, 2/11/2012, 119.06, 5
							</p>
							<br>
							<b>Portfolio and Watchlist</b>
							<br>
							<span>Click on a checkbox next to any stock to see it plotted on the graph in the center. On the graph, hover over a trend to see the price of the share at a given time. Access the different graphs for Portfolio and Watchlist through the tabs on top.</span>
							<br><br>
							<b>Buy/Sell Stock</b>
							<br>
							<span>Enter the ticker name of a company and the amount of shares to buy. Click on the sell tab to sell an owned stock. Using the dropdown, select which stock to sell and how many shares.</span> 
						</p>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		<table class ="portfolioPage" style=" border-collapse: separate; border-spacing: 15px;">
			<thead>
			</thead>
				<tbody>
					<!-- Top -->
					<tr>
						<!-- Import csv -->
						<td style ="width: 400px; height: 80px; text-align:center">
							<h4>Import .csv File</h4>
							<input style="    display: inline;border: 1px solid gainsboro;  padding: 5px;" type="file"  id="exampleInputFile">
						</td>

						<!-- Search -->
						<td style="width:50%;     text-align: -webkit-center;">
							<div>
							    <div class="input-group" style="width: 60%;border-collapse: collapse;">
							    	<form action='' method='post'>
									    <input name="searchQuery" type="text" class="form-control" id="stockSearch" placeholder="Search for...">
									    <span class="input-group-btn">
							        		<button type="submit" id="addToWatchList" name="addToWatchList" class="btn btn-default"> Add to Watchlist</button>
							        	</span>
							        </form>
							   		<?php 
							   			if(isset($_POST["addToWatchList"]) && $_POST["searchQuery"] !== '') {
							   				$query = $_POST["searchQuery"];
							   				$_SESSION['userObject']->watchStock($query);
							   			} 
							   		?>
							      
							    </div><!-- /input-group -->
							  </div><!-- /.col-lg-6 -->
						</td>

						<!-- Date, User Manual, Logout -->
						<td style="width:25%; text-align:center ">
							<div class="timeDisplay"></div>
							<div class="dateDisplay"></div>
							<div class="userManual">
							    <a  class="pointer"data-toggle="modal" id="userManual" data-target="#myModal">User Manual</a>

							</div>
							<a class="pointer" href="../logout/logout.php">Log Out</a>
							


						</td>
					</tr>

					<!-- Middle -->
					<tr>
						<!-- Portfolio of seven stocks -->
						<td  style="height:480px; width:30%; background-color: white; padding-top:0px;">
							<div style="">
							<h2 style="padding-bottom:10px; margin-top:0px; text-align:center; vertical-align:middle">Portfolio</h2>
							<div style="overflow-y: scroll; max-height: 321px">
								
								<table style="margin-bottom:0px" class="table table-striped table-hover table-bordered table-responsive  portfolioWidget">
									<tbody>
										<tr>
											<th style="width: 90px">
												Ticker
											</th>
											<th style="width:200px">
												Name
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

									<?php 
											$array = $_SESSION['userObject']->getStocks();
											if(is_array($array)){
												foreach($array as $key => $value ){
												echo '
												<tr>
													<td>'
													. $value->getTickerSymbol() .
													'</td>
													<td>'
													. $value->getName() .
													'</td>
													<td>'
													. $value->getQuantityOwned() .
													'</td>
													<td>'
													. MarkitAPI::getCurrentPrice($value->getTickerSymbol()) .
													'</td>
													<td style="padding:0px">
														<div class="checkbox">
														    	<input type="checkbox" class="" style="margin-left: 0px !important; position: initial;"> 
														</div>
													</td>
												</tr>';
											}
										}
											
										?>
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
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist" >
								<li role="presentation" class="active" style="width:50%; text-align:center"><a href="#portfolioGraph" aria-controls="portfolioGraph" role="tab" data-toggle="tab">Portfolio</a>
								</li>
								<li role="presentation"  style="width:50%; text-align:center"><a href="#watchlistGraph" aria-controls="watchlistGraph" role="tab" data-toggle="tab">Watchlist</a>
								</li>
							</ul>
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="portfolioGraph"></div>
								<div role="tabpanel" class="tab-pane" id="whatlistGraph"></div>
						</td>

						<!-- Watchlist -->

<!--					<td style="padding-top:0px">
							<h2 style="padding-bottom:10px; margin-top:0px; text-align:center; vertical-align:middle">Watchlist</h2>
							<div style="overflow-y: scroll; max-height: 321px" >
								<table class="table table-striped table-hover table-bordered table-responsive  portfolioWidget">
									<tbody>
										<tr>
											<th style="width:200px"> Name </th>
											
											<th style="width: 10px; max-width: 28px;">
												<i class="fa fa-line-chart"></i>
											</th>

										</tr>
										<?php 
											if(isset($_POST["addToWatchList"]) && $_POST["searchQuery"] !== '') {
												$array = $_SESSION['userObject']->getWatchedStock();
												foreach( $array as $key => $value ){
													echo '
													<tr>
														<td>'
														. $value->getName() .
														'</td>
														<td style="padding:0px">
															<div class="checkbox">
															    	<input type="checkbox" class="" style="margin-left: 0px !important; position: initial;"> 
															</div>
														</td>
													</tr>';
												}
											}
										?>
									</tbody>
								</table>
								</div>
						</td>
-->
					</tr>

 					<!-- Bottom -->
<!--					<tr>
						
						<td class="buySellWidget" style="    height: 255px;padding-top: 0px; display: table; border-collapse: collapse;">
						<div>

							<!-- Nav tabs 
							<ul class="nav nav-tabs" role="tablist" >
								<li role="presentation" class="active" style="width:50%; text-align:center"><a href="#buyStock" aria-controls="buyStock" role="tab" data-toggle="tab">Buy Stock</a></li>
								<li role="presentation"  style="width:50%; text-align:center"><a href="#sellStock" aria-controls="sellStock" role="tab" data-toggle="tab">Sell Stock</a></li>
								
							</ul>

							<!-- Tab panes 
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="buyStock">
									<form action='' method='post' id="buyStockForm" style="padding-top:10px">
										<div class="form-group" style="display: inline-block;">
											<label for="companyToBuyName">Ticker Name</label>
											<input name="companyToBuyName" type="text" style="width:200px" class="form-control" id="companyToBuyName" placeholder="Company">
										</div>
										<div class="form-group" style="display: inline-block; width: 100px;">
											<label for="companyToBuyQuantity">Quantity</label>
											<input name="companyToBuyQuantity" type="number" class="form-control" id="companyToBuyQuantity" placeholder="1">
										</div>
										<div style="text-align:center">
											<button name="buyStockSubmit" type="submit" style="width:100px;" class="btn btn-default">Buy</button>
										</div>
									</form> 
									<?php 
										if(isset($_POST["buyStockSubmit"]) && $_POST["companyToBuyName"] !== '') {
											$tickerName = $_POST["companyToBuyName"];
											$tickerQuantity = $_POST["companyToBuyQuantity"];
											$date = getdate();
											$_SESSION['userObject']->buyStock($tickerName, $tickerQuantity, $date);
											echo count( $_SESSION['userObject']->getStocks());
										}
									?>
								</div>
								<div role="tabpanel" class="tab-pane" id="sellStock">
									<form id="sellStockForm" style="padding-top:10px">
								
										
										<div class="form-group" style="display: inline-block;">
											<label for="companyToSell">Ticker Name</label>

												<div class="dropdown"  >
													<button class="btn btn-default dropdown-toggle" type="button" id="companyToSell" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width:200px">
														<span class="dropdownText">Dropdown</span>
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu scrollable-menu" aria-labelledby="dropdownMenu1">
														<li><a href="#">Apple</a></li>
														<li><a href="#">Apple</a></li>
														<li><a href="#">Apple</a></li>
														<li><a href="#">Apple</a></li>

														<li><a href="#">Apple</a></li>

														<li><a href="#">Another company</a></li>
														<li><a href="#">Something else here</a></li>
														
													</ul>
												</div>		
										</div>								
										<div class="form-group" style="display: inline-block; width: 100px; padding-top:0px">
											<label for="companyToBuyQuantity">Quantity</label>
											<input type="number" class="form-control" id="companyToBuyQuantity" placeholder="1">
										</div>
										<div style="text-align:center">
											<button type="submit" style="width:100px;" class="btn btn-default">Sell</button>
										</div>
									</form> 
								</div>
								
							</div>							
						</td>
						<td style="height:200px ">

							<?php 
								if(isset($_POST["addToWatchList"]) && $_POST["searchQuery"] !== '') {
									$query = $_POST["searchQuery"];
									$result = json_decode(MarkitAPI::quote($query));

									foreach($result as $key => $value){
										echo $key.'='.$value.'<br>';
									}

									echo '$result->LastPrice';
								}
							?>
						</td>
						<td style="height:200px; background-color:white">
							<img src="../../images/logo.jpg" style="width:inherit; height:inherit">

						</td>

					</tr>
 -->					
				</tbody>

		</table>

		<?php 
			$ar = $_SESSION['userObject']->getStocks();
			echo json_encode($ar); 
		?>

		<script>
			var ar = <?php echo json_encode($ar) ?>;
			LineGraph.initialize(ar, 3560);
		</script>

		<script>
			$(function () {
			    var seriesOptions = [],
			        seriesCounter = 0,
			        names = ['MSFT', 'AAPL', 'GOOG'];

			    /**
			     * Create the chart when all data is loaded
			     * @returns {undefined}
			     */
			    function createChart() {

			        $('#portfolioGraph').highcharts('StockChart', {

			            rangeSelector: {
			                selected: 4
			            },

			            yAxis: {
			                labels: {
			                    formatter: function () {
			                        return (this.value > 0 ? ' + ' : '') + this.value + '%';
			                    }
			                },
			                plotLines: [{
			                    value: 0,
			                    width: 2,
			                    color: 'silver'
			                }]
			            },

			            plotOptions: {
			                series: {
			                    compare: 'percent'
			                }
			            },

			            tooltip: {
			                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>',
			                valueDecimals: 2
			            },

			            series: seriesOptions
			        });
			    }

			    $.each(names, function (i, name) {

			        $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=' + name.toLowerCase() + '-c.json&callback=?',    function (data) {

			            seriesOptions[i] = {
			                name: name,
			                data: data
			            };

			            // As we're loading the data asynchronously, we don't know what order it will arrive. So
			            // we keep a counter and create the chart when all the data is loaded.
			            seriesCounter += 1;

			            if (seriesCounter === names.length) {
			                createChart();
			            }
			        });
			    });
			});
		</script>


	</body>

</html>