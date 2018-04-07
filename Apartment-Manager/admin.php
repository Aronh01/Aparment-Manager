<?php 
session_start(); 

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
unset($_SESSION['delete2']);
unset($_SESSION['erus']);

?>
<!DOCTYPE html>
<html>
<head>
        <link href="http://fonts.googleapis.com/css?family=Varela" rel="stylesheet" />
	<link rel="Stylesheet" type="text/css" href="resources\styles\default.css" />
</head>
<?php if (!isset($_SESSION['id'])) {	
	header('Location: index.php');
	exit();
}?>

<div id="wrapper">
	<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="admin.php">Apartment Manager</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li><a href="adminsetmessage.php" accesskey="5" title="">Set Message</a></li>
				<li><a href="viewusers.php" accesskey="5" title="">View Users</a></li>
				<li><a href="Model/logout.php" accesskey="5" title="">Logout</a></li>
			</ul>
		</div>
	</div>
    </div>
</div>
<div class="login-page">
<div class="form2">
<p>
	<?php echo "<p>Hello ".$_SESSION['Login']. " !</p>";
	
?>

</p>
 </div>
</div>
</body>
</html>