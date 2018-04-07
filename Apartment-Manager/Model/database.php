<?php

class database {
    static $host, $database, $user, $password;
	var $id; 

    function __construct($host = "localhost", $database="aniziol", $user="root", $password=""){
        self::$host=$host;
        self::$database=$database;
        self::$user=$user;
        self::$password=$password;
    }

    function connect(){
        $connection = mysqli_connect(self::$host, self::$user, self::$password,  self::$database);

        if($connection){
            return $connection;
        }else{
            return die("connection error!");
        }
    }
	
    function query($q=""){
		$connection = mysqli_connect(self::$host, self::$user, self::$password,  self::$database);
		$x = mysqli_query($connection, $q);
		$this->id = mysqli_insert_id($connection);
		return $x;
	}
	
	function getid(){
		return $this->id;
	}
	
	function transaction($Q){
		$connection = mysqli_connect(self::$host, self::$user, self::$password,  self::$database);
        mysqli_query($connection, "START TRANSACTION");
        for ($i = 0; $i < count ($Q); $i++){
            if (!mysqli_query($connection, $Q[$i])){
                echo 'Error! Info: <' . mysqli_error($connection) . '> Query: <' . $Q[$i] . '>';
                break;
            }  
        }

        if ($i == count ($Q)){
            mysqli_query($connection, "COMMIT");
            return 1;
        }
        else {
            mysqli_query($connection, "ROLLBACK");
            return 0;
        }
    }
}


?>
