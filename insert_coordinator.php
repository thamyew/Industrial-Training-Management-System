<!DOCTYPE html>
<html>
	<head>
		<title>Insert Coordinator</title>
		<link rel="stylesheet" href="message.css">
	</head>
<?php
session_start(); // Start up your PHP Session

// If the user is not logged in send him/her to the login form
if ($_SESSION["Login"] != "YES") 
header("Location: login.php");

if ($_SESSION["LEVEL"] == 1) {


         $coor_staff_no = $_POST["coor_staff_no"];
         $coor_ic = $_POST["coor_ic"];
         $coor_name = $_POST["coor_name"];
         $coor_address = $_POST["coor_address"];
         $coor_phone = $_POST["coor_phone"];
         $coor_email = $_POST["coor_email"];
         $coor_username = $_POST["coor_username"];
		 $coor_password = $_POST["coor_password"];

	     require ("config.php"); //call config.php to open connection to database before performing insert data
		 
		 $sql = "INSERT INTO login VALUES ('$coor_username','$coor_password','Coordinator')" ;
	     $sql1 = "INSERT INTO coordinator(coor_staff_no, coor_ic, coor_name, coor_address, coor_phone, coor_email, coor_username) VALUES ('$coor_staff_no', '$coor_ic', '$coor_name', '$coor_address', '$coor_phone', '$coor_email', '$coor_username')";

		 echo "<div class='message_box'>";

		if (mysqli_query($conn, $sql) and mysqli_query($conn, $sql1)) {
			echo "<h1>New Coordinator Created</h1>";
		} else {
			echo "<h1>Error: " . $sql . "<br>" . mysqli_error($conn) . "</h1>";
		}

	     mysqli_close($conn);

		 echo "<div class = 'button_box'><a href='view_coor_list.php'>Click here to view updated list of coordinators</a></div></div>";

		} else if ($_SESSION["LEVEL"] != 1) {
	
			echo "<p>Wrong User Level! You are not authorized to view this page</p>";
			   
			echo "<p><a href='main.php'>Go back to main page</a></p>";
			
			echo "<p><a href='logout.php'>LOGOUT</a></p>";
		   
			 }
			 
	   ?>
</html>