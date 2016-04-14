<?php 
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
?>
<html>
    <head>
        <script src="../vendors/jquery-1.12.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../vendors/bootstrap-3.3.6-dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../styles/styles.css">
    </head>

<body>
    <div id="regPage">
        <div class="moduleDiv regAndLogForm">
            <h1 class="moduleTitle">Register</h1>

            <form id="regForm" action="?" method="post">
                <fieldset class="form-group">
                    <label for="formGroupExampleInput">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="halfond@gmail.com"><br />
                    <span class="error"> <?php echo $emailError;?> </span>
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password"><br />
                    <span class="error"> <?php echo $passwordError;?> </span>
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Verify Password</label>
                    <input type="password" class="form-control" name="password2" id="password2" placeholder="Re-type Password"><br />
                    <span class="error"> <?php echo $repeatPasswordError;?> </span>
                </fieldset>
                
                <span class="error"> <?php echo $registrationError;?> </span>
                <button name="submit" id="submit" class="formButton btn btn-default" >Register</button>

                <p class="haveAccount">Already have an account? <a href="../index.php">Log In</a> </p>
            
            </form>
        </div>
    </div>
</body>       
</html>