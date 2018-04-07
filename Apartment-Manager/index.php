<!DOCTYPE html>
<?php include_once "Model/login.php";
session_start();
error_reporting(0);

unset($_SESSION['erlog']);
unset($_SESSION['ername']);
unset($_SESSION['ersurname']);
unset($_SESSION['erpass']);
unset($_SESSION['erpass2']);
unset($_SESSION['eremail']);
unset($_SESSION['ergen']);
unset($_SESSION['errdate']);


?>
<html>
<head>
	<link href="http://fonts.googleapis.com/css?family=Varela" rel="stylesheet" />
    <link rel="Stylesheet" type="text/css" href="resources\styles\styles.css" />
</head>
<body>
</div>
    <div class="login-page">
    <div class="form">
      <form class="login-form" action="Controller/Controller.php?method=login" method=post>
        <input type="text" name="Username" placeholder="Username"/>
        <input type="password" name="Password" placeholder="Password"/>
		<p class="error"><?php echo $_SESSION['msg']; ?></p>
        <input type="submit" value="Submit">

        <p class="message">Not registered? <a href="register.php">Create an account</a></p>
      </form>
    </div>
  </div>
  </body>
  </html>