<script type="text/javascript">

var data = [];
var options = 
	{
		emptyDataMessage: "Please select an account to display data",
		scaleType: "date",
		scaleDateFormat: "mm/dd/yyyy"
	};

var ctx = document.getElementById('graph').getContext('2d');
updateGraph();

function updateGraph(cb) {
	// Get selected account numbers
	var selected = [];
	$('#accounts input:checked').each(function() {
	    selected.push($(this).attr('id'));
	});

	// Convert user transactions to js
	// var json_transactions = <?php echo json_encode($transactions_json); ?>;
	// console.log(transactions);

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
		for(j = 0; j < json_transactions.length; j++)
		{
			if(number == json_transactions[j]['number']) 
			{
				data_set.label = json_transactions[j]['account'];
				var date = new Date(json_transactions[j]['date']);
				balance += parseFloat(json_transactions[j]['amount']);
				var point = {
					x: date,
				    y: balance,
				};
				data_set.data.push(point);
				console.log(data_set.data);
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

/*
$(function () 
{   
    $('#from_date, #to_date').datepicker(
    	{
	        showOn: "both",
	        beforeShow: customRange,
	        dateFormat: "dd M yy",
	        firstDay: 1, 
	        changeFirstDay: false
    	}
    );
});

function customRange(input) 
{ 
	// TODO: Get min. and max. transaction date

    var min = new Date(2008, 11 - 1, 1); //Set this to your absolute minimum date
	var dateMin = min;
	var dateMax = null;
	var dayRange = 6; // Set this to the range of days you want to restrict to

    if(input.id === "from_date") 
    {
        if($("#to_date").datepicker("getDate") != null) 
        {
            dateMax = $("#to_date").datepicker("getDate");
            dateMin = $("#to_date").datepicker("getDate");
            dateMin.setDate(dateMin.getDate() - dayRange);
            if(dateMin < min) 
            {
                dateMin = min;
            }
        }
        else 
        {
            dateMax = new Date; //Set this to your absolute maximum date
        }                      
    }
    else if(input.id === "to_date") 
    {
        dateMax = new Date; //Set this to your absolute maximum date
        if($("#from_date").datepicker("getDate") != null) 
        {
            dateMin = $("#from_date").datepicker("getDate");
            var rangeMax = new Date(dateMin.getFullYear(), dateMin.getMonth(), dateMin.getDate() + dayRange);

            if(rangeMax < dateMax) 
            {
                dateMax = rangeMax; 
            }
        }
    }

    return 
    {
        minDate: dateMin, 
        maxDate: dateMax
    };     
}
*/

</script>