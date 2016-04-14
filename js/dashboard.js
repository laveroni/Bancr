/*
    Send user data using AJAX
    Get which accounts are selected
    Display graph using those accounts


function updateGraph() 
{
    var selected = [];
    $('#checkboxes input:checked').each(function() {
        selected.push($(this).attr('id'));
    });
}

function date_compare($a, $b)
{
    $t1 = strtotime($a["x"]);
    $t2 = strtotime($b["x"]);
    return $t1 - $t2;
}   

function encodeAccount($account_name) 
{
    $account = $user->getAccountsArray()[$account_name];
    $history = $account->getHistory();
    $balance = 0;
    $transactions = array();
    for($i = 0; $i < count($); $i++)
    {
        $date = $history[$i]->getDate();
        $date = date_create_from_format('m/j/Y', $date);
        $balance += $history[$i]->getAmount();
        $transactions[] = array("x" => $date, "y" => $balance);
    }
    usort($transactions, 'date_compare');
    echo json_encode($transactions);
}
*/

var data = [
    {
      label: 'A',
      strokeColor: '#F16220',
      pointColor: '#F16220',
      pointStrokeColor: '#fff',
      data: 
    }
  ];

var options = [
    scaleType: "date",
    scaleDateFormat: "mmm d yyyy",
  ];
  

var ctx = document.getElementById("chart").getContext("2d");
new Chart(ctx).Scatter(data, options);

