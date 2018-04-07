<?php 

session_start(); 
error_reporting(0);
include_once "Model/database.php"; 
include_once "Model/User.php"; 
$mysqlConnect = new database();
$mysqlConnect->connect();
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
?>
<!DOCTYPE html>
<html>
<head>
        <link href="http://fonts.googleapis.com/css?family=Varela" rel="stylesheet" />
        <link href="resources\styles\default2.css" rel="stylesheet" type="text/css" media="all" />
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
	<table>
        <thead>
          <tr>
			<th>Id User</th>
            <th>Login</th>
            <th>Email</th>
            <th>Password</th>
          </tr>
        </thead>
        <tbody>	
			<?php
				getUsers();
			?>
		</tbody>	
	</table>	
	
<div class="form">
	<span style="display:inline-block; height:100px;"></span>	
	<form class="login-form" action="Controller/Controller.php?method=DeleteUser" method="post" enctype="multipart/form-data">
        <input type="text" name="duser"  placeholder="Enter user id"/><p class="error"><?php echo $_SESSION['erus']; ?></p>
		<input type="submit" value="Delete user and his booking and added apartments" />
    </div>
	</div>
	</form>
	</div>
</p>
 </div>
</div>
</body>
</html>