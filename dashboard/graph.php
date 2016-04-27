


<script type="text/javascript">

var json_transactions = <?php echo json_encode($transactions_json); ?>;
var selected = [];
var min_date, max_date, default_from_date, default_to_date;

function getRange() 
{
	// Default dates (last 3 months)
	default_from_date = new Date();
	default_from_date.setMonth(default_from_date.getMonth() - 3);
	default_to_date  = new Date();

	// Check whether user has transaction data
	if(json_transactions.length <= 0 || selected.length == 0) 
	{
		$("#from_date_text").val("");
    	$("#to_date_text").val("");
	} 
	else 
	{
		min_date = new Date(json_transactions[0]['date']);
		max_date = new Date(json_transactions[0]['date']);
	}

	// Get selected transaction data
	for(i = 0; i < selected.length; i++) 
	{
		for(j = 0; j < json_transactions.length; j++)
		{
			if(selected[i] == json_transactions[j]['number']) 
			{
				var date = new Date(json_transactions[j]['date']);
				if(date < min_date) 
				{
					min_date = date;
				}
				if(date > max_date) 
				{
					max_date = date;
				}
			}
		}
	}
}

function updateGraph(cb) 
{
	// Get selected account numbers
	selected = [];
	$('#accounts input:checked').each(function() {

	    selected.push($(this).attr('id'));
	});

	// Update range of dates
	getRange();

	// Get user input from datepicker
	var from_date = $("#from_date_text").datepicker("getDate");
	var to_date = $("#to_date_text").datepicker("getDate");


	if(!from_date || from_date > to_date /*|| from_date < min_date || from_date > max_date*/) 
    {
        from_date = default_from_date;
    } 

	if(!to_date || to_date < from_date /*|| to_date < min_date || to_date > max_date*/) 
    {
        to_date = default_to_date;
    } 
	 
	
    // Update datepicker
    $("#from_date_text").datepicker ({
    	defaultDate: from_date 
    });

    $("#to_date_text").datepicker ({
    	defaultDate: to_date 
    });

    // Update text boxes with date
    from_date_text = (from_date.getMonth() + 1) + "/" + from_date.getDate() + "/" + from_date.getFullYear();
    to_date_text = (to_date.getMonth() + 1) + "/" + to_date.getDate() + "/" + to_date.getFullYear();

    $("#from_date_text").val(from_date_text);
    $("#to_date_text").val(to_date_text);

	// Get relevant transaction data
	var data = [];
	for(i = 0; i < selected.length; i++) 
	{
		var number = selected[i];
		var data_set = {
			// label: number,
		    strokeColor: '#01DF01',
		    pointColor: '#01DF01',
		    pointStrokeColor: '#fff',
		    data: []
		};
		
		var balance = 0;
		// Get selected transaction data
		for(j = 0; j < json_transactions.length; j++)
		{
			if(number == json_transactions[j]['number']) 
			{
				data_set.label = json_transactions[j]['account'];
				var date = new Date(json_transactions[j]['date']);
				if(date >= from_date && date <= to_date) 
				{
					balance += parseFloat(json_transactions[j]['amount']);
					balance.toPrecision(2);
					var point = {
						x: date,
					    y: balance,
					};
					// console.log(point.x);
					data_set.data.push(point);
				}
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

	var ctx = document.getElementById('graph').getContext('2d');
	var chart = new Chart(ctx).Scatter(data, {
		emptyDataMessage: "Please select an account to display data or update time range",
		bezierCurve: false,
		scaleType: "date",
		scaleDateFormat: "mm/dd/yy",
		scaleDateTimeFormat: "mm/dd/yy",
		pointDotRadius: 2,
		pointHitDetectionRadius: 1,
		scaleShowLabels: true,
	});
}

updateGraph();
</script>