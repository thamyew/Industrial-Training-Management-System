<?php

require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

$sql = "CREATE TABLE IF NOT EXISTS admin(
		admin_staff_no VARCHAR(10) PRIMARY KEY,
		admin_ic VARCHAR(20) UNIQUE NOT NULL,
		admin_name VARCHAR(50) NOT NULL,
		admin_address VARCHAR(100) NOT NULL,
		admin_phone VARCHAR(20) UNIQUE NOT NULL,
		admin_email VARCHAR(20) UNIQUE NOT NULL,
		admin_username VARCHAR(20) NOT NULL,
		FOREIGN KEY (admin_username) REFERENCES login(login_username))";

if (mysqli_query($conn, $sql)) {
  echo "<h3>Table admin created successfully</h3>";
}

// Initialize the first admin of the database
// Checking whether the table admin already has data or not
$sql = "SELECT * FROM admin";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

// Check if no data
if ($count == 0)
{
	// Insert default login data
	$sql = "INSERT INTO login VALUES('admin', 'admin', 'Admin')";
	mysqli_query($conn, $sql);
	// Insert default admin data
	$sql = "INSERT INTO admin VALUES('ADMIN', 'ADMIN', 'ADMIN', 'ADMIN', 'ADMIN', 'ADMIN', 'admin')";
	mysqli_query($conn, $sql);
}
?>