<!DOCTYPE html>
<html>
	<head>
		<title>Insert Administrator</title>
		<link rel="stylesheet" href="message.css">
	</head>
<?php
session_start(); // Start up your PHP Session

// If the user is not logged in send him/her to the login form
if ($_SESSION["Login"] != "YES") 
header("Location: login.php");

if ($_SESSION["LEVEL"] == 1) {

         $admin_staff_no = $_POST["admin_staff_no"];
         $admin_ic = $_POST["admin_ic"];
         $admin_name = $_POST["admin_name"];
         $admin_address = $_POST["admin_address"];
         $admin_phone = $_POST["admin_phone"];
         $admin_email = $_POST["admin_email"];
         $admin_username = $_POST["admin_username"];
		 $admin_password = $_POST["admin_password"];

	     require ("config.php"); //call config.php to open connection to database before performing insert data
		 
		 $sql = "INSERT INTO login VALUES ('$admin_username','$admin_password','Admin')" ;

	     $sql1 = "INSERT INTO admin(admin_staff_no, admin_ic, admin_name, admin_address, admin_phone, admin_email, admin_username) VALUES ('$admin_staff_no', '$admin_ic', '$admin_name', '$admin_address', '$admin_phone', '$admin_email', '$admin_username')";

		 echo "<div class='message_box'>";

		if (mysqli_query($conn, $sql) and mysqli_query($conn, $sql1)) {
			echo "<h1>New Administrator Created</h1>";
		} else {
			echo "<h1>Error: " . $sql . "<br>" . mysqli_error($conn) . "</h1>";
		}

	     mysqli_close($conn);

		 echo "<div class = 'button_box'><a href='view_admin_list.php'>Click here to view updated list of administrators</a></div></div>";

		} else if ($_SESSION["LEVEL"] != 1) {
	
			echo "<p>Wrong User Level! You are not authorized to view this page</p>";
			   
			echo "<p><a href='main.php'>Go back to main page</a></p>";
			
			echo "<p><a href='logout.php'>LOGOUT</a></p>";
		   
			 }
			 
	   ?>
</html>