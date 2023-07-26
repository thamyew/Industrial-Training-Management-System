<?php

require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp


$sql = "CREATE TABLE IF NOT EXISTS student(
		stud_matric_no VARCHAR(10) PRIMARY KEY,
		stud_ic VARCHAR(20) UNIQUE NOT NULL,
		stud_name VARCHAR(50) NOT NULL,
		stud_address VARCHAR(100) NOT NULL,
		stud_phone VARCHAR(20) UNIQUE NOT NULL,
		stud_email VARCHAR(20) UNIQUE NOT NULL,
		stud_username VARCHAR(20) NOT NULL,
		FOREIGN KEY (stud_username) REFERENCES login(login_username))";

if (mysqli_query($conn, $sql)) {
  echo "<h3>Table student created successfully</h3>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}
?>