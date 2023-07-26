<!DOCTYPE html>
<html>
	<head>
		<title>Delete Coordinator</title>
		<link rel="stylesheet" href="message.css">
	</head>
<?php
// Start up your PHP Session
session_start();
// If the user is not logged in send him/her to the login form
if ($_SESSION["Login"] != "YES") 
header("Location: login.php");
 
if ($_SESSION["LEVEL"] == 1) { 

	$staff_no = $_GET["id"];
	require ("config.php");

	$sql = "SELECT coor_username FROM coordinator WHERE coor_staff_no = '$staff_no'";
	$query = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($query);
	$delete_username = $result['coor_username'];

	$sql = "DELETE FROM coordinator WHERE coor_staff_no = '$staff_no'"; 
   $sql1 = "DELETE FROM login WHERE login_username='$delete_username'";

   echo "<div class='message_box'>";

   if (mysqli_query($conn, $sql) and mysqli_query($conn, $sql1)) {
	  echo "<h1>Coordinator Deleted</h1>";
	  } else {
		  echo "<h1>Error: " . $sql . "<br>" . mysqli_error($conn) . "</h1>";
		  }

   mysqli_close($conn);
	  
   echo "<div class='button_box'><a href='view_coor_list.php'>Click here to view updated list of coordinators</a></div>";

   echo "</div>";
		 		  
// If the user is not correct level
} else {
	
  echo "<p>Wrong User Level! You are not authorized to view this page</p>";
	 
  echo "<p><a href='main.php'>Go back to main page</a></p>";
  
  echo "<p><a href='logout.php'>LOGOUT</a></p>";
 
	}
	   ?>
</html>