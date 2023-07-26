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

		 $sql = "SELECT stud_username FROM student WHERE stud_matric_no = '$ID'";
		 $query = mysqli_query($conn, $sql);
		 $result = mysqli_fetch_assoc($query);
		 $delete_username = $result['stud_username'];

		 $sql = "DELETE FROM practicalTrainingApplication WHERE stud_matric_no='$ID'";

		 mysqli_query($conn, $sql);

	     $sql1 = "DELETE FROM student WHERE stud_matric_no = '$ID'";

	     mysqli_query($conn, $sql);

		 $sql2 = "DELETE FROM login WHERE login_username='$delete_username'";

		 echo "<div class='message_box'>";

		if (mysqli_query($conn, $sql) and mysqli_query($conn, $sql1) and mysqli_query($conn, $sql2)) {
			echo "<h1>Student Deleted</h1>";
			} else {
				echo "<h1>Error: " . $sql . "<br>" . mysqli_error($conn) . "</h1>";
				}

		mysqli_close($conn);
			
		echo "<div class='button_box'><a href='view_student_list.php'>Click here to view updated list of students</a></div>";

		echo "</div>";
		  
// If the user is not correct level
} else if ($_SESSION["LEVEL"] != 1) {
	
  echo "<p>Wrong User Level! You are not authorized to view this page</p>";
	 
  echo "<p><a href='main.php'>Go back to main page</a></p>";
  
  echo "<p><a href='logout.php'>LOGOUT</a></p>";
 
	}
 
  ?> 
</html>