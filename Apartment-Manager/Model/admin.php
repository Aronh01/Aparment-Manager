<?php 
function SetMessage(){ 
	session_start(); 
	$mysqlConnect = new database();
    $mysqlConnect->connect();
	$temp_amsg = $_POST['adminmessage'];
	$mysqlConnect->query("UPDATE admin_message SET message ='$temp_amsg' WHERE Id_msg = '1'");
	header('Location: ../admin.php'); } 
?>