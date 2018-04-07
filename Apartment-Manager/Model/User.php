<?php


function getUsers(){
    $mysqlConnect = new database();
    $mysqlConnect->connect();
    $query = $mysqlConnect->query("SELECT * FROM Users Where Role = '1'");

    while($user=mysqli_fetch_array($query)){

        echo '<tr><td>'.$user['id_Users'].'</td><td>'.$user['Login'].'</td><td>'.$user['Email'].'</td><td>'.$user['Password'].'</td></tr>';
    }
}		
$_SESSION['erlog']="";
$_SESSION['ername']="";
$_SESSION['ersurname']="";
$_SESSION['erpass']="";
$_SESSION['erpass2']="";
$_SESSION['eremail']="";
$_SESSION['ergen']="";
$_SESSION['errdate']="";
$_SESSION['deleteuser']="";
function insertUser(){
	session_start();
	$isCorrect = 0;
    $mysqlConnect = new database();
    $mysqlConnect->connect();
	$temp_login = $_POST['login'];
	if((strlen($temp_login)<3) || (strlen($temp_login)>20))
	{
		$_SESSION['erlog']="Nick must have 3-20 letters";
		$isCorrect = 1;
	}else{
		$_SESSION['erlog']="";
	}
    $temp_imie = $_POST['imie'];
	if((strlen($temp_imie)==0))
	{
		$_SESSION['ername']="Enter name";
		$isCorrect = 1;
	}else{
		$_SESSION['ername']="";
	}
    $temp_nazwisko = $_POST['nazwisko'];
	if((strlen($temp_nazwisko)==0))
	{
		$_SESSION['ersurname']="Enter surname";
		$isCorrect = 1;
	}else{
		$_SESSION['ersurname']="";
	}
	
	$temp_number = $_POST['number'];
	if((strlen($temp_number)==0))
	{
		$_SESSION['ernumber']="Enter telephone number";
		$isCorrect = 1;
	}else{
		$_SESSION['ernumber']="";
	}
	
    $temp_email = $_POST['email'];
	if (!filter_var($temp_email, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['eremail']="Invalid email format";
		$isCorrect = 1;
	}else{
		$_SESSION['eremail']="";
	}
    $temp_haslo = $_POST['haslo'];
    $temp_haslo2 = $_POST['haslo2'];
	if((strlen($temp_haslo)==0))
	{
		$_SESSION['erpass']="Enter password";
		$isCorrect = 1;
	}else{
		$_SESSION['erpass']="";
	}
	if(($temp_haslo!=$temp_haslo2))
	{
		$_SESSION['erpass2']="Passwords are not equal";
		$isCorrect = 1;
	}else{
		$_SESSION['erpass2']="";
	}
	$temp_data = $_POST['data'];
	list($y, $m, $d) = explode('-', $temp_data);
	if(!checkdate($m, $d, $y)){
		$_SESSION['errdate']="Enter Correct data";
		$isCorrect = 1;
		}else{
			$_SESSION['errdate']="";
		}
	$temp_gender = $_POST['gender']; 
	if(!isset($_POST['gender'])){ 
        $_SESSION['ergen']="Select gender";
		$isCorrect = 1;
    }else{
		$_SESSION['ergen']="";
	}
	if($isCorrect == 0){
		$mysqlConnect->query("INSERT INTO `User_Details` VALUES ('NULL','$temp_imie', '$temp_nazwisko', '$temp_gender','$temp_number');");
		$user_id = $mysqlConnect->getid();
		$_SESSION['us_id']=$user_id;
		$mysqlConnect->query("INSERT INTO `Users` VALUES ('$user_id','$temp_login', '$temp_email', '$temp_haslo', '$temp_data','$user_id','1');");
		header('Location: ../index.php');		
	}else if ($isCorrect == 1){
		header('Location: ../register.php');
	}
}

function UpdateUser(){
	session_start();
	$isCorrect = 0;
    $mysqlConnect = new database();
    $mysqlConnect->connect();
	$temp_login = $_POST['login'];
	if((strlen($temp_login)<3) || (strlen($temp_login)>20))
	{
		$_SESSION['erlog']="Nick must have 3-20 letters";
		$isCorrect = 1;
	}else{
		$_SESSION['erlog']="";
	}
    $temp_imie = $_POST['imie'];
	if((strlen($temp_imie)==0))
	{
		$_SESSION['ername']="Enter name";
		$isCorrect = 1;
	}else{
		$_SESSION['ername']="";
	}
    $temp_nazwisko = $_POST['nazwisko'];
	if((strlen($temp_nazwisko)==0))
	{
		$_SESSION['ersurname']="Enter surname";
		$isCorrect = 1;
	}else{
		$_SESSION['ersurname']="";
	}
	
	$temp_number = $_POST['number'];
	if((strlen($temp_number)==0))
	{
		$_SESSION['ernumber']="Enter telephone number";
		$isCorrect = 1;
	}else{
		$_SESSION['ernumber']="";
	}
	
    $temp_email = $_POST['email'];
	if (!filter_var($temp_email, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['eremail']="Invalid email format";
		$isCorrect = 1;
	}else{
		$_SESSION['eremail']="";
	}
    $temp_haslo = $_POST['haslo'];
    $temp_haslo2 = $_POST['haslo2'];
	if((strlen($temp_haslo)==0))
	{
		$_SESSION['erpass']="Enter password";
		$isCorrect = 1;
	}else{
		$_SESSION['erpass']="";
	}
	if(($temp_haslo!=$temp_haslo2))
	{
		$_SESSION['erpass2']="Passwords are not equal";
		$isCorrect = 1;
	}else{
		$_SESSION['erpass2']="";
	}
	$temp_data = $_POST['data'];
	list($y, $m, $d) = explode('-', $temp_data);
	if(!checkdate($m, $d, $y)){
		$_SESSION['errdate']="Enter Correct data";
		$isCorrect = 1;
		}else{
			$_SESSION['errdate']="";
		}
	$temp_gender = $_POST['gender']; 
	if(!isset($_POST['gender'])){ 
        $_SESSION['ergen']="Select gender";
		$isCorrect = 1;
    }else{
		$_SESSION['ergen']="";
	}
	$user_id = $_SESSION['id'];
	$sql[0] = "UPDATE Users SET Login = '$temp_login',Email = '$temp_email',Password= '$temp_haslo',Register_date= '$temp_data' WHERE id_Users = $user_id;";
	$sql[1] = "UPDATE User_Details SET First_name = '$temp_imie',Second_name = '$temp_nazwisko',Gender = '$temp_gender',Number= '$temp_number' WHERE id_User_details = $user_id;";
	if($isCorrect == 0){	
		$mysqlConnect->Transaction($sql);
		header('Location: ../home.php');	
		$_SESSION['alerts']=1;
		$_SESSION['message'] = "Profile updated!";		
	}else if ($isCorrect == 1){
		header('Location: ../updateuser.php');
	}
}
function DeleteUser(){
	session_start();
	$isCorrect = 0;
    $mysqlConnect = new database();
    $mysqlConnect->connect();
	$temp_user = $_POST['duser'];
	if((strlen($temp_user)==0))
	{
		$_SESSION['erus']="Enter Correct id";
		$isCorrect = 1;
	}else{
		$_SESSION['erus']="";
	}
	$query2 = $mysqlConnect->query("SELECT * FROM users WHERE Id_Users = $temp_user");
	$u = $query2->num_rows;
	if($u>0)
	{
		$_SESSION['erus']="";
	}else{
		$_SESSION['erus']="There is no user with that id";
		$isCorrect = 1;		
	}	
	$sql1 = "Select * from Property Where id_User_Details = $temp_user;";
	if($isCorrect == 0){
	$query = $mysqlConnect->query($sql1);
		if ($query->num_rows > 0) {	
			while($row = mysqli_fetch_array($query)) {
				$Adres = $row["id_Adress"];
				$Curr = $row["id_Currency"];
				$id_prop = $row["id_Property"];
				$file_path = "../".$row["File_path"];
				unlink($file_path);
				$mysqlConnect->query("Delete from property Where id_Adress =$Adres AND id_Currency =$Curr ;");
				$mysqlConnect->query("Delete from adress Where id_Adress =$Adres ;");
				$mysqlConnect->query("Delete from booking Where id_Property =$id_prop ;");		
			}
		}
	$mysqlConnect->query("Delete from currency Where id_Currency =$Curr ;");
	$mysqlConnect->query("Delete from booking Where id_User_Details =$temp_user ;");
	$mysqlConnect->query("Delete from Users Where id_Users =$temp_user ;");
	$mysqlConnect->query("Delete from User_Details Where id_User_Details =$temp_user ;");	
	header('Location: ../viewusers.php');
	}else{
		header('Location: ../viewusers.php');
	}
}





?>