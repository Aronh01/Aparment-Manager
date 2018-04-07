<?php 
session_start(); 
include_once "Model/database.php";
error_reporting(0);
$mysqlConnect = new database();
$mysqlConnect->connect();
$sql = "Select message from admin_message where Id_msg=1";
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

?>
<!DOCTYPE html>
<html>
<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
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
<p>
	<?php echo "<p>Hello ".$_SESSION['Login']. "  ".$_SESSION['id']."!</p>";
?>	
<script type="text/javascript">
function updateTime(){
    var currentTime = new Date()
    var hours = currentTime.getHours()
    var minutes = currentTime.getMinutes()
	var seconds = currentTime.getSeconds()
    if (minutes < 10){
        minutes = "0" + minutes
    }
    var t_str ="Current time is:  " +hours + ":" + minutes + ":"+ seconds + " ";
    if(hours > 11){
        t_str += "PM";
    } else {
        t_str += "AM";
    }
    document.getElementById("time").innerHTML = t_str;
}
setInterval(updateTime, 1);
</script>
	<p id="time"></p>
	<?php echo $_SESSION['hello']. "<br><br>"; ?>
	<h3>Admin Message:</h3>
	<?php 
		$query = $mysqlConnect->query($sql);
		if ($query->num_rows > 0) {	
			while($row = mysqli_fetch_array($query))
			echo $row["message"];
		} 
	?>
</p>
 </div>
</div>
</body>
</html>