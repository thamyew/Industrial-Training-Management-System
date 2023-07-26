<!DOCTYPE html>
<html>
	<head>
		<title>Delete Student</title>
		<link rel="stylesheet" href="message.css">
	</head>
<?php
// Start up your PHP Session
session_start();
// If the user is not logged in send him/her to the login form
if ($_SESSION["Login"] != "YES") 
header("Location: login.php");
 
if ($_SESSION["LEVEL"] == 1) { 

		 $ID = $_GET["id"];
 
	     require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

	     $sql = "DELETE FROM practicalTrainingApplication WHERE application_id = '$ID'" ;

	     $result = mysqli_query($conn, $sql);

	     echo "<div class='message_box'>";

		if (mysqli_query($conn, $sql)) {
			echo "<h1>Application Deleted</h1>";
			} else {
				echo "<h1>Error: " . $sql . "<br>" . mysqli_error($conn) . "</h1>";
				}

		mysqli_close($conn);
			
		echo "<div class='button_box'><a href='view_practical_training_application.php'>Click here to view updated list of applications</a></div>";

		echo "</div>";
		  
// If the user is not correct level
} else if ($_SESSION["LEVEL"] != 1) {
	
  echo "<p>Wrong User Level! You are not authorized to view this page</p>";
	 
  echo "<p><a href='main.php'>Go back to main page</a></p>";
  
  echo "<p><a href='logout.php'>LOGOUT</a></p>";
 
	}
 
  ?>
</html>   