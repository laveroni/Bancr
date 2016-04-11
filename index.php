


<html>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <head>
  	<title>Bancr</title>
    	<!-- Bootstrap core CSS -->
      <link href="./css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom styles for this template -->
      <link href="./css/signin.css" rel="stylesheet">
          
        <style>
            h2  {
                text-align: center;
                }
        </style>
          
  </head>

  <!-- ensure values aren't empty-->
  <script>
    $(document).ready(function() { //display error message when fields are blank
      $('#signInButton').on('click', function(e) {
        if ( $('#email').val() == '' && $('#password').val() == '' ){
          console.log('test');
          $('#errors').html('Error: fields are blank');
          e.preventDefault();
        }
      });
    });
  </script>



  <?php
  
    session_start(); 

    if(!$_SESSION['loginErrorMessage'] || !isset($_SESSION['loginErrorMessage']))
    {
      $_SESSION['loginErrorMessage'] = " ";
    }

    if(!$_SESSION['loginAttempts'] || !isset($_SESSION['loginAttempts']))
    {
      $_SESSION['loginAttempts'] = 0;
    }

    if($_SESSION['loginAttempts'] == 4)
    {
      //set a boolean session variable for disabled 
      $_SESSION['loginErrorMessage'] = "<br>Account Locked For 1 Minute:<br>4 Incorrect Login Attempts<br>";

      $_SESSION['timeout'] = true;

    }


?>





  <body>
    
    <body style="background-color:#333333;">
    <!--<body background="money.jpg">-->
  	<div class="container">

       <form class="form-signin" method="POST" id="logForm" action="scripts/login/signin.php">
       <form class="form-signin" id="loginform" method="POST" action="scripts/login/signin.php">
       <!--<form class="form-signin">-->
          <h2 class="form-signin-heading"><font color="light green">Bancr</h2></font>
          
          <h4 class="form-signin-heading">
              <font color="blue" font-weight="bold">Enter your email and password
              </font>
          <h4></h4>
          <label for="inputEmail" class="sr-only" >Email address</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Email address" autofocus <?php if ($_SESSION['loginAttempts'] == 4){ echo 'disabled="disabled"'; } ?>>
          <label for="inputPassword" class="sr-only" >Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" <?php if($_SESSION['loginAttempts'] == 4){ echo 'disabled="disabled"'; } ?>>
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" id="signInButton" <?php if($_SESSION['loginAttempts'] == 4){ echo 'disabled="disabled"'; } ?>>Sign in</button>

          <?php echo '<div style="color:red;">' . $_SESSION['loginErrorMessage'] . '</div>'; ?>

        </form>

        <button name="logout" id="logout" value="logout" type="submit" style="width:100px;" class="btn btn-default" onclick="window.location.href='scripts/logout/logout.php'">
          Logout
        </button>

      </div> <!-- /container -->
  </body>
</html>


<?php

  if (isset($_SESSION['timeout']) && $_SESSION['timeout'] == true) 
    {
      //done waiting for a minute
      $_SESSION['loginAttempts'] = 0;
      $_SESSION['loginErrorMessage'] = " ";
      $_SESSION['timeout'] = false;
      header( "refresh:60; url=index.php" );
    }

?>

<!--$http.post('SignInData/testSignIn2.php', {email: email, password: password);-->
