<?php include_once "../Model/database.php"; ?>
<?php include_once "../Model/User.php"; ?>
<?php include_once "../Model/login.php"; ?>
<?php include_once "../Model/Apartment.php"; ?>
<?php include_once "../Model/Booking.php"; ?>
<?php include_once "../Model/admin.php"; ?>

<?php

if(isset($_GET['method'])){
    if($_GET['method']=="insertUser"){
            insertUser();
    }if($_GET['method']=="login"){
			login();
    }if($_GET['method']=="insertApartment"){
			insertApartment();
    }if($_GET['method']=="insertBooking"){
			insertBooking();
    }if($_GET['method']=="UpdateUser"){
			UpdateUser();
    }if($_GET['method']=="DeleteBooking"){
			DeleteBooking();
    }if($_GET['method']=="DeleteApartment"){
			DeleteApartment();
    }if($_GET['method']=="DeleteUser"){
			DeleteUser();
    }if($_GET['method']=="SetMessage"){
			SetMessage();
    }else{
			echo "Wrong method!";
			die();
    }
}

?>