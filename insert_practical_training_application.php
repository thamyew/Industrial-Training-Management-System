<!DOCTYPE html>
<html>
	<head>
		<title>Insert Practical Training Application</title>
		<link rel="stylesheet" href="message.css">
	</head>
<?php
// Start up your PHP Session
session_start();
// If the user is not logged in send him/her to the login form
if ($_SESSION["Login"] != "YES") 
header("Location: login.php");
 
if ($_SESSION["LEVEL"] != 2) { 
			
	     $company_name = $_POST["company_name"];
		 $company_address = $_POST["company_address"];
	     $company_phone = $_POST["company_phone"];
	     $company_email = $_POST["company_email"];
	     $training_startdate = $_POST["training_startdate"];
	     $training_enddate = $_POST["training_enddate"];
		 $stud_matric_no = $_POST["stud_matric_no"];

	     require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

	     $sql = "INSERT INTO practicalTrainingApplication(company_name, company_address, company_phone, company_email, training_startdate, training_enddate, stud_matric_no) VALUES ('$company_name','$company_address','$company_phone','$company_email', '$training_startdate', '$training_enddate', '$stud_matric_no')" ;
	     echo "<div class='message_box'>";

		if (mysqli_query($conn, $sql)) {
			echo "<h1>New Application Created</h1>";
		} else {
			echo "<h1>Error: " . $sql . "<br>" . mysqli_error($conn) . "</h1>";
		}

		 mysqli_close($conn);
		 
		 echo "<div class = 'button_box'><a href='view_practical_training_application.php'>Click here to view updated list of applications</a></div></div>";
	  
// If the user is not correct level
} else if ($_SESSION["LEVEL"] != 1) {
	
  echo "<p>Wrong User Level! You are not authorized to view this page</p>";
	 
  echo "<p><a href='main.php'>Go back to main page</a></p>";
  
  echo "<p><a href='logout.php'>LOGOUT</a></p>";
 } ?>
</html>