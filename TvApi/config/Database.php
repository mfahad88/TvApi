<?php
class Database{

	// specify your own database credentials
//     private  $host = "localhost";
//     private $db_name = "tv_app";
//     private $username = "root";
//     private $password = "";
	public $conn;

	// get the database connection
	public function getConnection(){
		// Create connection
	    $conn = mysqli_connect("localhost", "root", "","tv_app");
		
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
// 		echo "Connected successfully";
		return $conn;
	}
}
