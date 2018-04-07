<?php
$_SESSION['erapartment']="";
$_SESSION['erd']="";
$_SESSION['erdelete']="";
$_SESSION['alerts']="";
$_SESSION['message']="";
function insertBooking(){
	session_start();
	date_default_timezone_set('Europe/Warsaw');
	$isCorrect = 0;
    $mysqlConnect = new database();
    $mysqlConnect->connect();
	$today1 = date("y-m-d");
	$temp_id_apartment = $_POST['apartment_id'];	
	$temp_date_start = new DateTime($_POST['date1']);
	$temp_date_end = new DateTime($_POST['date2']);
	$today = new DateTime($today1);
	$temp_date_start = $temp_date_start->format('Y-m-d');
	$temp_date_end = $temp_date_end->format('Y-m-d');
	$today = $today->format('Y-m-d');
	$query2 = $mysqlConnect->query("Select Start_date, End_date from Booking WHERE Booking.id_property ='$temp_id_apartment';");
	if ($query2->num_rows > 0) 
	{
		while($row = mysqli_fetch_array($query2)) 
		{
			$start_db = strtotime($row["Start_date"]);
			$end_db = strtotime($row["End_date"]);
			$start_entered = strtotime($temp_date_start);
			$end_entered = strtotime($temp_date_end);
			if((($start_entered >= $start_db) && ($start_entered <= $end_db) || ($end_entered >= $start_db) && ($end_entered <= $end_db)) || (($start_entered <= $start_db)  &&  ($end_entered >= $end_db)) ){
				$isCorrect = 1;
				$_SESSION['erdatab'] = "Sorry, this term is reserved for this property";
			}
		}
		
	}
	if ($temp_date_start > $temp_date_end)
	{
		$_SESSION['erdatab']="invalid datas";
		$isCorrect = 1;
	}
	if ($temp_date_start < $today)
	{
		$_SESSION['erdatab']="invalid datas";
		$isCorrect = 1;
	}
	if ($temp_date_end < $today)
	{
		$_SESSION['erdatab']="invalid datas";
		$isCorrect = 1;
	}
	if((strlen($temp_id_apartment)==0))
	{
		$_SESSION['erapartment']="Enter apartment id";
		$isCorrect = 1;
	}else{
		$_SESSION['erapartment']="";
		if($query = $mysqlConnect->query("Select * from Property WHERE id_property ='$temp_id_apartment';"))
		{
			$apartment = $query->num_rows;
			if($apartment>0)
			{
				$_SESSION['erapartment']="";
			}else{
				$_SESSION['erapartment']="There is no apartment with that id";
				$isCorrect = 1;
			}
		}	
	}
	if($isCorrect == 0){
		$user_id = $_SESSION['id'];
		$mysqlConnect->query("INSERT INTO `Booking` VALUES ('NULL','$temp_date_start', '$temp_date_end', '$today','$user_id','$temp_id_apartment');");
		header('Location: ../home.php');	
		$_SESSION['alerts']=1;
		$_SESSION['message'] = "Booking added!";
	}else if ($isCorrect == 1){
		header('Location: ../addbooking.php');
	}
}

function DeleteBooking(){
	session_start();
	date_default_timezone_set('Europe/Warsaw');
	$isCorrect = 0;
    $mysqlConnect = new database();
    $mysqlConnect->connect();
	$temp_delete = $_POST['delete'];
	$user_id = $_SESSION['id'];
	$sql[0] = 	"DELETE FROM Booking
				WHERE id_booking=$temp_delete AND
				id_User_details=$user_id;";
	if((strlen($temp_delete)==0))
	{
		$_SESSION['delete']="Enter apartment id";
		$isCorrect = 1;
	}else{
		$_SESSION['delete']="";
		
	}
	if($isCorrect == 0){
		$_SESSION['alerts']=1;
		$_SESSION['message'] = "Booking deleted!";
		$mysqlConnect->transaction($sql);
		header('Location: ../home.php');
	}else if ($isCorrect == 1){
		header('Location: ../viewprofile.php');
	}

}

?>