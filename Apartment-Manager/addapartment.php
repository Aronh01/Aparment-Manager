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

<script>
</script>
    <div class="login-page">
    <div class="form">
      <form class="login-form" action="Controller/Controller.php?method=insertApartment" method="post" enctype="multipart/form-data">
        <h4>Add Apartment</h4>
		  <input type="text" name="Street" placeholder="Enter street name"/><p class="error"><?php echo $_SESSION['erstreet']; ?></p>
          <input type="text" name="Country"  placeholder="Enter Country name"/><p class="error"><?php echo $_SESSION['erkraj']; ?></p>
		  <input type="text" name="Postcode"  placeholder="Enter Poscode"/><p class="error"><?php echo $_SESSION['erkod']; ?></p>
		  <input type="text" name="Flat"  placeholder="Enter Flat numebr"/><p class="error"><?php echo $_SESSION['erflat']; ?></p>
		  <input type="text" name="Property"  placeholder="Enter property number"/><p class="error"><?php echo $_SESSION['erprop']; ?></p>
		  <div class="col-half">
              <div class="col-price">
                <input type="text" name="price"  placeholder="Enter Price"/><p class="error"><?php echo $_SESSION['ercena']; ?></p>
              </div>
              <div class="col-price">
                <input type="text" name="valut" placeholder="Enter Valut"/><p class="error"><?php echo $_SESSION['erwaluta']; ?></p>
              </div>
                <input type="text" name="bedroms" placeholder="Enter bedroms count"/><p class="error"><?php echo $_SESSION['eriloscs']; ?></p>
		  </div>
		  <input type="file" name="fileToUpload" id="fileToUpload"><p class="error"><?php echo $_SESSION['erimage']; ?></p>
		  <textarea rows="4" cols="50" name="comment"  placeholder="Enter description here..."></textarea><p class="error"><?php echo $_SESSION['eropis']; ?></p>
		 <button>Submit</button>
      </form>
    </div> 
  </div>
  </body>
  </html>