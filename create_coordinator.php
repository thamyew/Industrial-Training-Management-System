<?php
 
require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp


$sql = "CREATE TABLE IF NOT EXISTS coordinator(
		coor_staff_no VARCHAR(10) PRIMARY KEY,
		coor_ic VARCHAR(20) UNIQUE NOT NULL,
		coor_name VARCHAR(50) NOT NULL,
		coor_address VARCHAR(100) NOT NULL,
		coor_phone VARCHAR(20) UNIQUE NOT NULL,
		coor_email VARCHAR(30) UNIQUE NOT NULL,
		coor_username VARCHAR(20) NOT NULL,
		FOREIGN KEY (coor_username) REFERENCES login(login_username))";
 

if (mysqli_query($conn, $sql)) {
  echo "<h3>Table coordinator created successfully</h3>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}
?>