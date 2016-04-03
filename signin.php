<html>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <head>
  	<title>Bancr</title>
    	<!-- Bootstrap core CSS -->
      <link href="./vendors/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">

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

  <body>
    
    <body style="background-color:#333333;">
    <body background="money.jpg">
  	<div class="container">

       <form class="form-signin" method="POST" action="scripts/login/signin.php" id="logForm">

       <!--<form class="form-signin">-->
          <h2 class="form-signin-heading"><font color="light green">Bancr</h2></font>
          
          <h4 class="form-signin-heading">
              <font color="blue" font-weight="bold">Enter your email and password
              </font>
          <h4></h4>
          <label for="inputEmail" class="sr-only" >Email address</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Email address" autofocus>
          <label for="inputPassword" class="sr-only" >Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" id="signInButton">Sign in</button>



        </form>
      </div> <!-- /container -->
  </body>
</html>


<!--$http.post('SignInData/testSignIn2.php', {email: email, password: password);-->
