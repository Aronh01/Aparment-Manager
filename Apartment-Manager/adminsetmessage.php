<?php include_once "Model/Apartment.php"; 
session_start();
error_reporting(0);
unset($_SESSION['erapartment']);
unset($_SESSION['erdatab']);
unset($_SESSION['delete']);
unset($_SESSION['delete2']);
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
			<h1><a href="admin.php">Apartment Manager</a></h1>
		</div>
		<div id="menu">
			<ul>

				<li><a href="adminsetmessage.php" accesskey="4" title="">Set Message</a></li>
				<li><a href="viewusers.php" accesskey="5" title="">View Users</a></li>
				<li><a href="Model/logout.php" accesskey="5" title="">Logout</a></li>
			</ul>
		</div>
	</div>
    </div>
</div>

<script>
</script>
    <div class="login-page">
    <div class="form">     
    <h4>Set Message</h4>
      <form class="login-form" action="Controller/Controller.php?method=SetMessage" method="post" enctype="multipart/form-data">
			<textarea rows="4" cols="50" name="adminmessage"  placeholder="Enter description here..."></textarea>
			<button>Submit</button>
		</form>
	</div>
</div>
  </body>
  </html>