<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "IndustrialTrainingDatabase";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS IndustrialTrainingDatabase";
if (mysqli_query($conn, $sql)) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}

include 'create_login.php';
include 'create_admin.php';
include 'create_coordinator.php';
include 'create_student.php';
include 'create_practicalTrainingApplication.php';

//And finally we close the connection to the MySQL server
mysqli_close($conn);
?>
