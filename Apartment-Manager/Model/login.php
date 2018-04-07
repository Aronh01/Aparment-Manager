<?php
include_once "database.php";

$_SESSION['msg'] = "";
function login(){

	session_start();
	$mysqlConnect = new database();
    $mysqlConnect->connect();
	$Username = $_POST['Username'];
	$Password = $_POST['Password'];
	
	if($query = @$mysqlConnect->query("SELECT * FROM Users WHERE Login='$Username' AND Password='$Password'"))
	{
		$user = $query->num_rows;
		if($user>0)
		{
			$wiersz = mysqli_fetch_array($query);
			$_SESSION['Login'] = $wiersz['Login'];
			$_SESSION['id'] = $wiersz['id_Users'];
			if($wiersz['Role'] == 2){
				header('Location: ../admin.php');
				$query->free_result();
				$_SESSION['msg'] = "";
			}else{
				$_SESSION['hello'] = "You have successfully logged into the system! Now you can start using the application to manage the database for the apartment management
     you can view the list of apartments, facilities for each apartment. When done with using the application please logout of the application.";
				header('Location: ../home.php');
			}
		}else{
			$_SESSION['msg'] = "Wrong username or password";
			header('Location: ../index.php');
		}
	}
}
?>