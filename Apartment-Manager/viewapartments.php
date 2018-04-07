<?php 

session_start(); 
include_once "Model/database.php"; 
include_once "Model/Apartment.php"; 
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
unset($_SESSION['erapartment']);
unset($_SESSION['erdatab']);
unset($_SESSION['delete']);
unset($_SESSION['deleteap']);
unset($_SESSION['hello']);
?>
<!DOCTYPE html>
<html>
<head>
        <link href="http://fonts.googleapis.com/css?family=Varela" rel="stylesheet" />
        <link href="resources\styles\default.css" rel="stylesheet" type="text/css" media="all" />
</head>
<?php if (!isset($_SESSION['id'])) {	
	header('Location: index.php');
	exit();
}?>

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
<div class="form2">
<p>
	<?php
		ViewApartments();
	?>
</p>
 </div>
</div>
</body>
</html>