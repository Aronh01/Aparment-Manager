<?php
$_SESSION['erstreet']="";
$_SESSION['erkraj']="";
$_SESSION['erkod']="";
$_SESSION['erflat']="";
$_SESSION['erprop']="";
$_SESSION['ercena']="";
$_SESSION['erwaluta']="";
$_SESSION['eropis']="";
$_SESSION['erimage']="";
$_SESSION['eriloscs']="";
$_SESSION['deleteap']="";
function insertApartment(){
	session_start();
	$isCorrect = 0;
    $mysqlConnect = new database();
    $mysqlConnect->connect();
	
	$temp_ulica = $_POST['Street'];
	if((strlen($temp_ulica)==0))
	{
		$_SESSION['erstreet']="Enter street";
		$isCorrect = 1;
	}else{
		$_SESSION['erstreet']="";
	}
    $temp_kraj = $_POST['Country'];
	if((strlen($temp_kraj)==0))
	{
		$_SESSION['erkraj']="Enter country";
		$isCorrect = 1;
	}else{
		$_SESSION['erkraj']="";
	}
    $temp_kod = $_POST['Postcode'];
	if((strlen($temp_kod)==0))
	{
		$_SESSION['erkod']="Enter postcode";
		$isCorrect = 1;
	}else{
		$_SESSION['erkod']="";
	}
    $temp_numerF = $_POST['Flat'];
	if((strlen($temp_numerF)==0))
	{
		$_SESSION['erflat']="Enter Flat Number";
		$isCorrect = 1;
	}else{
		$_SESSION['erflat']="";
	}
    $temp_numerP = $_POST['Property'];
	if((strlen($temp_numerP)==0))
	{
		$_SESSION['erprop']="Enter Property Number";
		$isCorrect = 1;
	}else{
		$_SESSION['erprop']="";
	}
    $temp_cena = $_POST['price'];
	if((strlen($temp_cena)==0))
	{
		$_SESSION['ercena']="Enter Price";
		$isCorrect = 1;
	}else{
		$_SESSION['ercena']="";
	}
	$temp_waluta = $_POST['valut'];
	if((strlen($temp_waluta)==0))
	{
		$_SESSION['erwaluta']="Enter Valut";
		$isCorrect = 1;
	}else{
		$_SESSION['erwaluta']="";
	}
	$temp_iloscs = $_POST['bedroms'];
	if((strlen($temp_iloscs)==0))
	{
		$_SESSION['eriloscs']="Enter bedrom count";
		$isCorrect = 1;
	}else{
		$_SESSION['eriloscs']="";
	}
	$temp_opis = $_POST['comment'];
	if((strlen($temp_opis)==0))
	{
		$_SESSION['eropis']="Enter description";
		$isCorrect = 1;
	}else{
		$_SESSION['eropis']="";
	}
	$target_dir = "../resources/uploads/";
	$target_dir2 = "resources/uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);		
	$target_database = $target_dir2 . basename($_FILES["fileToUpload"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if ($_FILES["fileToUpload"]["size"] > 500000) {
    $_SESSION['erimage'] = "Sorry, your file is too large.";
    $isCorrect = 1;
	}
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
    $_SESSION['erimage'] ="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $isCorrect = 1;
	}
	
	if($isCorrect == 0){
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);
		$mysqlConnect->query("INSERT INTO `Adress` VALUES ('NULL','$temp_kraj', '$temp_ulica', '$temp_numerF', '$temp_numerP', '$temp_kod');");
		$addres_id = $mysqlConnect->getid();
		$mysqlConnect->query("INSERT INTO `Currency` VALUES ('NULL','$temp_cena', '$temp_waluta');");
		$currency_id = $mysqlConnect->getid();
		$user_id = $_SESSION['id'];
		$mysqlConnect->query("INSERT INTO `Property` VALUES ('NULL','$temp_opis', '$temp_iloscs', '$addres_id', '$currency_id','$user_id','$target_database');");
		header('Location: ../home.php');
		$_SESSION['alerts']=1;
		$_SESSION['message'] = "Apartment added!";
	}else if ($isCorrect == 1){
		header('Location: ../addapartment.php');
	}
}


function DeleteApartment(){
	session_start();
	date_default_timezone_set('Europe/Warsaw');
	$isCorrect = 0;
    $mysqlConnect = new database();
    $mysqlConnect->connect();
	$temp_delete2 = $_POST['deleteap'];
	$user_id = $_SESSION['id'];
	$query3 = $mysqlConnect->query(	"Select id_Currency,id_Adress,File_path FROM Property Where id_property=$temp_delete2;");
	$row = mysqli_fetch_array($query3);
	$Adres = $row["id_Adress"];
	$Curr = $row["id_Currency"];
	$file_path = "../".$row["File_path"];
	$sql[0] = 	"DELETE FROM Booking
				WHERE id_Property=$temp_delete2;";
	$sql[1] = 	"DELETE FROM Property
				WHERE id_Property=$temp_delete2;";
	$sql[2] = 	"DELETE FROM Adress
				WHERE id_Adress=$Adres;";
	$sql[3] = 	"DELETE FROM Currency
				WHERE id_Currency=$Curr;";					

	
	if((strlen($temp_delete2)==0))
	{
		$_SESSION['delete2']="Enter apartment id";
		$isCorrect = 1;
	}else{
		$_SESSION['delete2']="";
		
	}
	if($isCorrect == 0){
		unlink($file_path);
		$mysqlConnect->Transaction($sql);				
		header('Location: ../home.php');
		$_SESSION['alerts']=1;
		$_SESSION['message'] = "Apartment Deleted!";
	}else if ($isCorrect == 1){
		header('Location: ../viewprofile.php');
	}
}		
function ViewApartments(){
	$mysqlConnect = new database();
	$mysqlConnect->connect();
	$sql = "SELECT Property.id_property, Property.Description,Property.File_path, Adress.Country, Adress.Street, Adress.Flat_number, Adress.Property_number,Adress.Postcode, Currency.Value, Currency.Value_type, User_Details.First_name, User_Details.Second_name, User_Details.Number
			FROM (((Property
			INNER JOIN Adress ON Adress.id_Adress = Property.id_Adress)
			INNER JOIN Currency ON Currency.id_Currency = Property.id_Currency)
			INNER JOIN User_Details ON User_Details.id_User_details = Property.id_User_details)";
	$query = @$mysqlConnect->query($sql);
	
	if ($query->num_rows > 0) {
		while($row = mysqli_fetch_array($query)) {
			echo "<img src='".$row["File_path"]."' height=450 width=650/>";
			echo "<br><b><u> Property id:  </b></u> ". $row["id_property"]."<br>" ."<b><u> Description:  </b></u>". $row["Description"]."<br>". "<b><u>Street:  </b></u>". $row["Street"]. "<br>"."<b><u> Country:  </b></u>". $row["Country"]."<br>"."<b><u> Price:  </b></u>". $row["Value"]."  ". $row["Value_type"]."<br>"."<b><u> Added by:  </b></u>". $row["First_name"]."  ". $row["Second_name"]."<br>"."<b><u> Contact to owner:  </b></u>". $row["Number"]."<br>"."<br>"."<br>"."<br>"."<br>";
		}
	} 
}


?>