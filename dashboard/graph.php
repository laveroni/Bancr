<script type="text/javascript">

var data = [];
var options = 
	{
		emptyDataMessage: "Please select an account to display data",
		scaleType: "date",
		scaleDateFormat: "mm/dd/yyyy"
	};

var ctx = document.getElementById('graph').getContext('2d');
new Chart(ctx).Scatter(data, options);

function updateGraph(cb) {
	// Get selected account numbers
	var selected = [];
	$('#accounts input:checked').each(function() {
	    selected.push($(this).attr('id'));
	});

	// Convert user transactions to js
	var transactions = <?php echo json_encode($transactions_json); ?>;
	//console.log(transactions);

	// Get relevant transaction data
	data = [];
	for(i = 0; i < selected.length; i++) 
	{
		var number = selected[i];
		var balance = 0;

		var data_set = {
			// label: number,
		    strokeColor: '#01DF01',
		    pointColor: '#01DF01',
		    pointStrokeColor: '#fff',
		    data: []
		};
		// Get selected transaction data
		for(j = 0; j < transactions.length; j++)
		{
			if(number == transactions[j]['number']) 
			{
				data_set.label = transactions[j]['account'];
				var date = new Date(transactions[j]['date']);
				balance += parseFloat(transactions[j]['amount']);
				var point = {
					x: date,
				    y: balance,
				};
				data_set.data.push(point);
				//console.log(data_set.data);
			}
		}
		// Sort transaction data by date
		data_set.data.sort(
			function(a,b) 
			{
				return new Date(b.x) - new Date(a.x);
			}
		);

		if(balance < 0) 
		{ 	// Change line color to red if balance negative
			data_set.strokeColor = '#DF0101';
			data_set.pointColor = '#DF0101';
		}

		data.push(data_set);
	}
	new Chart(ctx).Scatter(data, options);
}
</script>