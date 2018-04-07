<?php include_once "Model/Booking.php"; 
session_start();
error_reporting(0);
unset($_SESSION['erstreet']);
unset($_SESSION['erkraj']);
unset($_SESSION['erkod']);
unset($_SESSION['erflat']);
unset($_SESSION['erprop']);
unset($_SESSION['ercena']);
unset($_SESSION['erwaluta']);
unset($_SESSION['eropis']);
unset($_SESSION['eriloscs']);
unset($_SESSION['erimage']);
unset($_SESSION['hello']);
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
      <form class="login-form" action="Controller/Controller.php?method=insertBooking" method="post" enctype="multipart/form-data">
        <h4>Add Booking</h4>
		  <input type="text" name="apartment_id"  placeholder="Enter property id"/><p class="error"><?php echo $_SESSION['erapartment']; ?></p>
		  <h4>Start and end date</h4>
		  <input type="date" name="date1" value="2018-01-01"/>
          <input type="date" name="date2"  value="2018-01-01"/><p class="error"><?php echo $_SESSION['erdatab']; ?></p>
		 <button>Submit</button>
      </form>
    </div> 
  </div>
  </body>
  </html>