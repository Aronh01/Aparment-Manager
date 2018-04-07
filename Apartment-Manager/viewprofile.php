<?php 
session_start(); 
error_reporting(0);
include_once "Model/database.php"; 
include_once "Model/Booking.php"; 
$mysqlConnect = new database();
$mysqlConnect->connect();
$user_id = $_SESSION['id'];
$sql = "SELECT *
FROM (Users
INNER JOIN User_Details ON Users.id_User_Details = User_Details.id_User_Details)
Where Users.id_User_Details = $user_id;";
$sql2 = "SELECT * FROM 
((Booking 
INNER JOIN Property ON Property.id_Property = Booking.id_Property)
INNER JOIN Currency ON Currency.id_Currency = Property.id_Currency)
Where Booking.id_User_Details = $user_id;";
$sql3 = "SELECT Property.id_property, Property.Description,Property.File_path, Adress.Country, Adress.Street, Adress.Flat_number, Adress.Property_number,Adress.Postcode, Currency.Value, Currency.Value_type, User_Details.First_name, User_Details.Second_name, User_Details.Number
FROM (((Property
INNER JOIN Adress ON Adress.id_Adress = Property.id_Adress)
INNER JOIN Currency ON Currency.id_Currency = Property.id_Currency)
INNER JOIN User_Details ON User_Details.id_User_details = Property.id_User_details)
Where Property.id_User_Details = $user_id;";
$query = @$mysqlConnect->query($sql);
$query2 = @$mysqlConnect->query($sql2);
$query3 = @$mysqlConnect->query($sql3);
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
unset($_SESSION['hello']);
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

<?php 
if($_SESSION['alerts']==1)
{?>
<div class="alert success">
  <div class="closebtn">&times;</div>  
  <p class="message"><?php echo $_SESSION['message']; ?></p>
</div>
<?php
$_SESSION['alerts']=0;
}
?>

<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}
</script>

<div class="login-page">
<div class="form2">
<h2><b><u>User Details:</b></u></h2>
<p>
	<?php
	$query = @$mysqlConnect->query($sql);
	if ($query->num_rows > 0) {
		while($row = mysqli_fetch_array($query)) {
		echo "<br> Login: ". $row["Login"]."<br>" ."Name: ". $row["First_name"]."<br>". "Surname: ". $row["Second_name"]. "<br>"."Email: ". $row["Email"]."<br>"."Birth date: ". $row["Register_date"]."<br>"."Telephone number: ". $row["Number"]."<br>"."<br>"."<br>";
		}
	} 
	?>
	<input type="button" onclick="location.href='updateuser.php';" value="Update profile" />
		<?php
		echo "<br>"."<br>"."<br>"."<br>"; ?>

		<h2><b><u>Your Apartments added:</b></u></h2>
		<?php
		$query3 = @$mysqlConnect->query($sql3);
		if ($query3->num_rows > 0) {
			while($row = mysqli_fetch_array($query3)) {
			echo "<img src='".$row["File_path"]."' height=450 width=650/>";
			echo "<br> Property id: ". $row["id_property"]."<br>" ."Description: ". $row["Description"]."<br>". "Street: ". $row["Street"]. "<br>"."Country: ". $row["Country"]."<br>"."Price: ". $row["Value"]."  ". $row["Value_type"]."<br>"."<br>"."<br>"."<br>";
			}
		} 
	?>

	<div class="form">
	<span style="display:inline-block; width:100;"></span>	
	<form class="login-form" action="Controller/Controller.php?method=DeleteApartment" method="post" enctype="multipart/form-data">
        <input type="text" name="deleteap"  placeholder="Enter property id"/><p class="error"><?php echo $_SESSION['delete2']; ?></p>
		<input type="submit" value="Delete Apartment" />
    </div>
	<span style="display:inline-block; height:50px;"></span>	
	</form>
	<h2><b><u>Your Bookings:</b></u></h2>
	<table>
        <thead>
          <tr>
			<th>Id booking</th>
            <th>Id property</th>
            <th>Start date</th>
            <th>End date</th>
			<th>Date made</th>
			<th>Price</th>
          </tr>
        </thead>
        <tbody>
		<?php
		$query2 = $mysqlConnect->query($sql2);
		if ($query2->num_rows > 0) {	
			while($row = mysqli_fetch_array($query2)) {
				$Start = new DateTime($row['Start_date']);
				$End = new DateTime($row['End_date']);
				$today = new DateTime($row['Date_made']);
				$strip = $Start->format('Y-m-d');
				$strip2 = $End->format('Y-m-d');
				$strip3 = $today->format('Y-m-d');
				$diff  = $End->diff($Start)->format('%a')+1;
				$sum = $diff * $row['Value'];
				echo '<tr><td>'.$row['Id_Booking'].'</td><td>'.$row['id_Property'].'</td><td>'.$strip.'</td><td>'.$strip2.'</td><td>'.$strip3.'</td><td>'.$sum." ".$row['Value_type'].'</td></tr>';
			}
		}
		?>
        </tbody>
      </table>
    <div class="form">
	<span style="display:inline-block; width:100;"></span>	
	<form class="login-form" action="Controller/Controller.php?method=DeleteBooking" method="post" enctype="multipart/form-data">
        <input type="text" name="delete"  placeholder="Enter property id"/><p class="error"><?php echo $_SESSION['delete']; ?></p>
		<input type="submit" value="Delete Booking" />
    </div>
	</div>
	</form>
	</div>
</p>
 </div>
</div>
</body>
</html>