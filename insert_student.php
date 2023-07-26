<!DOCTYPE html>
<html>
	<head>
		<title>Insert Student</title>
		<link rel="stylesheet" href="message.css">
	</head>
<?php
session_start(); // Start up PHP Session

// If the user is not logged in send him/her to the login form
if ($_SESSION["Login"] != "YES") 
header("Location: login.php");

if ($_SESSION["LEVEL"] == 1) 
{ 
	     $stud_matric_no = $_POST["stud_matric_no"];
	     $stud_ic = $_POST["stud_ic"];
	     $stud_name = $_POST["stud_name"];
		 $stud_address = $_POST["stud_address"];
		 $stud_phone = $_POST["stud_phone"];
		 $stud_email = $_POST["stud_email"];
		 $stud_username = $_POST["stud_username"];
		 $stud_password = $_POST["stud_password"];

	     $stud_matric_no = strtoupper($stud_matric_no);  // convert matric to uppercase

		 require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp
		 
		 // Insert new login data based on the entered student username and password
	     $sql = "INSERT INTO login VALUES ('$stud_username','$stud_password','Student')" ;
		 // Insert new student data based on the entered information
		 $sql1 = "INSERT INTO student VALUES ('$stud_matric_no', '$stud_ic', '$stud_name', '$stud_address', '$stud_phone', '$stud_email', '$stud_username')";
		 
		 echo "<div class='message_box'>";

		 if (mysqli_query($conn, $sql) and mysqli_query($conn, $sql1)) {
			 echo "<h1>New Student Created</h1>";
		 } else {
			 echo "<h1>Error: " . $sql . "<br>" . mysqli_error($conn) . "</h1>";
		 }
		
	     mysqli_close($conn);

		 echo "<div class = 'button_box'><a href='view_student_list.php'>Click here to view updated list of students</a></div></div>";
	   
// If the user is not correct level
} else if ($_SESSION["LEVEL"] != 1) {
	
  echo "<p>Wrong User Level! You are not authorized to view this page</p>";
	 
  echo "<p><a href='main.php'>Go back to main page</a></p>";
  
  echo "<p><a href='logout.php'>LOGOUT</a></p>";
 
   }
 
  ?>
</html>