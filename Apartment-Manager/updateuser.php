<?php include_once "Model/Apartment.php"; 
session_start();
error_reporting(0);
unset($_SESSION['erapartment']);
unset($_SESSION['erdatab']);
?>

<!DOCTYPE html>
<html>
<head>
	<?php if (!isset($_SESSION['id'])) {	
		header('Location: index.php');
		exit();
	}?>
    <link href="http://fonts.googleapis.com/css?family=Varela" rel="stylesheet" />
    <link rel="Stylesheet" type="text/css" href="resources\styles\register_style.css" />
	<link rel="Stylesheet" type="text/css" href="resources\styles\default.css" />
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="home.php">Apartment Manager</a></h1>
		</div>
		<div id="menu">
			<ul>
                <li><a href="viewprofile.php" accesskey="2" title="">Profile</a></li>
				<li><a href="addbooking.php" accesskey="3" title="">Add booking</a></li>
				<li><a href="addapartment.php" accesskey="4" title="">Add Apartment</a></li>
				<li><a href="viewapartments.php" accesskey="5" title="">View Apartments</a></li>
				<li><a href="Model/logout.php" accesskey="5" title="">Logout</a></li>
			</ul>
		</div>
	</div>
    </div>
</div>
    <div class="login-page">
    <div class="form">
      <form class="login-form" action="Controller/Controller.php?method=UpdateUser" method="post" enctype="multipart/form-data">
			<h4>Account</h4>
		  <input type="text"  name="login" placeholder="Login"/><p class="error"><?php echo $_SESSION['erlog']; ?></p>
          <input type="text" name="imie"  placeholder="Name"/><p class="error"><?php echo $_SESSION['ername']; ?></p>
          <input type="text"  name="nazwisko" placeholder="Surname"/><p class="error"><?php echo $_SESSION['ersurname']; ?></p>
		  <input type="text"  name="number" placeholder="Telephone number"/><p class="error"><?php echo $_SESSION['ernumber']; ?></p>
          <input type="text"  name="email" placeholder="E-mail"/><p class="error"><?php echo $_SESSION['eremail'];?></p>
          <input type="password"  name="haslo"  placeholder="Password"/>
          <input type="password" name="haslo2" placeholder="Confirm Password"/><p class="error"><?php echo $_SESSION['erpass']; echo $_SESSION['erpass2']; ?></p>
        <div class="col-half">
            <h4>Date of Birth</h4>
              <div class="col-date">
                <input type="date"  name="data"  value="2018-01-01" placeholder="YYY-MM-DD"/><p class="error"><?php echo $_SESSION['errdate'];?></p>
              </div>
          </div>
          <div class="col-gender">
              <h4>Gender</h4>
                <div class="col-gender">
                  <input type="radio" name="gender" value="male" id="gender-male"/>
                  <label for="gender-male" class="radio">Male</label>
                </div>
                <div class="col-gender">
                  <input type="radio" name="gender" value="female" id="gender-female"/>
                  <label for="gender-female" class="radio">Female</label>		  
				  <p class="error"><?php echo $_SESSION['ergen'];?></p>
                </div>
			</div>
		 <button>Submit</button>
      </form>
    </div> 
  </div>
  </body>
  </html>