<?php
 
require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp


$sql = "CREATE TABLE IF NOT EXISTS login(
		login_username VARCHAR(20) PRIMARY KEY,
		login_password VARCHAR(20) NOT NULL,
		login_usertype VARCHAR(12) NOT NULL)";

if (mysqli_query($conn, $sql)) {
  echo "<h3>Table login created successfully</h3>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}
?>