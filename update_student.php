<!DOCTYPE html>
<html>
	<head>
		<title>Update Student Data</title>
		<link rel="stylesheet" href="message.css">
	</head>
<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: index.php");   //send user to login page
 
if ($_SESSION["LEVEL"] != 2) 
{
	$stud_matric_no = $_POST["stud_matric_no"];
	$stud_ic = $_POST["stud_ic"];
	$stud_name = $_POST["stud_name"];
	$stud_address = $_POST["stud_address"];
	$stud_phone = $_POST["stud_phone"];
	$stud_email = $_POST["stud_email"];
 		 
	require("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

	$sql = "UPDATE student SET stud_ic = '$stud_ic' , stud_name = '$stud_name', stud_address = '$stud_address', 
			stud_phone = '$stud_phone' , stud_email = '$stud_email' WHERE stud_matric_no = '$stud_matric_no'";

	if ($_SESSION["LEVEL"] == 1)
	{
	echo "<div class='message_box_long'>";
	}
	else
	{
	echo "<div class='message_box'>";
	}  

	if (mysqli_query($conn, $sql)) {
	echo "<h1>Data Updated</h1>";
	} else {
	echo "<h1>Error: " . $sql . "<br>" . mysqli_error($conn) . "</h1>";
	}
	mysqli_close($conn);
	
	if ($_SESSION["LEVEL"] == 1)
	{
	echo "<div class = 'button_box'><a href='view_student.php?id=$stud_matric_no'>Click here to view updated student data</a></div>";
	echo "<div class = 'button_box'><a href='view_student_list.php'>Click here to view updated list of students</a></div>";
	}
	else
	{
	echo "<div class = 'button_box'><a href='view_profile.php'>Click here to view the updated profile</a></div>";
	}  

	echo "</div>";
	  
// If the user is not correct level
} else {
	
  echo "<p>Wrong User Level! You are not authorized to view this page</p>";
	 
  echo "<p><a href='main.php'>Go back to main page</a></p>";
  
  echo "<p><a href='logout.php'>LOGOUT</a></p>";
 
   }
 
  ?>
</html>