<?php

require_once('../scripts/UserClass/User.php');

session_start();

if (!isset($_SESSION['user']) || !isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'])
{
    header('Location: ../index.html');
    exit();
}

$user = (object) $_SESSION['user'];

file_put_contents('php://stderr', print_r($user, TRUE));
?>

<!DOCTYPE html>
<html lang='en'>
<head>    
    <!-- Meta -->
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible” content=”IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title>Bancr</title>
    
    <!-- CSS -->
    <link rel='stylesheet' href='../bootstrap/css/bootstrap.min.css'>
    <link rel='stylesheet' href='../css/dash.css'>
    

</head>
<body>
    <div class='container'>
        <div class='row header'>
            <div class='col col-xs-3 col-side name flex-ver'>
                <h1 id='appname' class=''>Bancr</h1>
            </div>
            <div class='col col-xs-6 banner flex-ver'>
                <p id='clock' class='time'>16:00</p>
                <p class='timezone'>Eastern Standard</p>
            </div>
            <div class='col col-xs-3 col-side account flex-ver'>
                <p id='username' class='label'>
                    <?php echo $_SESSION['email']; ?>
                    </p>
                <p id='balance' class='label'>
                    <span class='sublabel'>balance</span>
                    <span id="balance-amount">$<?php echo '00'; ?></span>
                    </p>
                <p id='net-value' class='label'> 
                    <span class='sublabel'>net value</span>
                    <span id="netValue-amount">$<?php echo '00'; ?></span>
                    </p>
            </div>
        </div>
        
        <div class='row toolbar'>
            <div class='col col-xs-3 col-side toolbar-left flex-hor'>

                <button id='csv' class='tool button' title='CSV Upload'>
                    <span class="glyphicon glyphicon-open-file" aria-hidden="true"></span>
                </button>
                
                <form id="csv-form" action="./uploadCSV.php" method="post" enctype="multipart/form-data">
                    <input type='file' name='csv-file' id='csv-file'>
                    <input type='submit' value='upload' name='submit'>
                </form>
                
            </div>
            <div class='col col-xs-6'>
                <input id='search' class='tool textfield'
                       type='text' placeholder='Search for a ticker or company' />
            </div>
            <div class='col col-xs-3 col-side toolbar-right flex-hor'>
                <button id='help' class='tool button' title='User Manual'>
                    <span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span>
                </button>
                <button id='logout' class='tool button' title='Log out'>
                    <span class='glyphicon glyphicon-log-out' aria-hidden='true'></span>
                </button>
            </div>
        </div>
        
        <div class='row content'>
            <div class='col col-xs-3 col-side'>
                <ul id='portfolio' class='module stock-list'>
                    
                </ul>
            </div>
            <div class='col col-xs-6'>
                <div id='graph-view' class='module graph-module flex-ver'>
                    <ul class="nav nav-tabs graph-tabs">
                        <li class='graph-tab active'><a href=''>Portfolio</a></li>
                        <li class='graph-tab'><a href=''>Watchlist</a></li>
                    </ul>
                    <div id="gContainer">
                    <canvas id='graph' width = 570 height = 300></canvas>
                    </div>
                    <ul id='interval-list' class='flex-hor'>
                        <li id='1d' class='interval'><a>1d</a></li>
                        <li id='5d' class='interval'><a>5d</a></li>
                        <li id='1m' class='interval'><a>1m</a></li>
                        <li id='3m' class='interval'><a>3m</a></li>
                        <li id='6m' class='interval'><a>6m</a></li>
                        <li id='all' class='interval'><a>All</a></li>
                    </ul>
                </div>
            </div>
            <div class='col col-xs-3 col-side'>
                <div class='module'>
                    <div id='legend'></div>
                    <ul id='watchlist' class='stock-list'>
                        
                        
                        
                    </ul>
                </div>
            </div>
        </div>
        
        <div class='row footer'>
            <div class='col col-xs-3 col-side'>
                <div id='transaction' class='module flex-ver'>
                    <div id='' class='target-row flex-hor'>
                        <input id='ticker-input' class='transaction-textfield'
                               type='text' placeholder="Ticker">
                        <input id='company-input' class='transaction-textfield'
                               type='text' placeholder="Company">
                    </div>
                    <div id='' class='qty-row flex-hor'>
                        <input id='qty-input' class='transaction-qty'
                               type='number' min='1' step='1' placeholder='Quantity'>
                    </div>
                    <div id='' class='msg-row'>
                        <p id='transaction-message' class='message'></p>
                    </div>
                    <div id='' class='confirm-row flex-hor'>
                        <button id='buy' class='transaction-button'>Buy</button>
                        <button id='sell' class='transaction-button'>Sell</button>
                    </div>
                </div>
            </div>
            <div class='col col-xs-6'>
                <div id='details' class='module'></div>
            </div>
            <div class='col col-xs-3 col-side'>
                <div id='recommendation' class='module'></div>
            </div>
        </div>
    </div>
    <script>
    $('#csv').click(function(e)
    {
        $('#csv-input').click();
    });
    </script>
</body>
</html>