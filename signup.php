<html>
  <head>
  	<title>Tickr</title>
    	<!-- Bootstrap core CSS -->
      <link href="./css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom styles for this template -->
      <link href="./css/signin.css" rel="stylesheet">
  </head>
  <body>
      
    <body style="background-color:#222222;">
  	<div class="container">

        <form class="form-signin" method="POST" action="/scripts/login/signin.php">
          <h2 class="form-signin-heading"><font color="white">Sign Up</h2></font>
          
          <h4 class="form-signin-heading"><font color="white">Enter your
                                <font color="purple">Email</font>
                                and <font color="red">Password</font> to
                                <font color="orange"> Sign Up</h2></font></font>
          
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign Up</button>
          <a href="index.html">Sign in</a></p>

        </form>
      </div> <!-- /container -->
  </body>
</html>