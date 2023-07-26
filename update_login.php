<!DOCTYPE html>
<html>
	<head>
		<title>Update Login Data</title>
		<link rel="stylesheet" href="message.css">
	</head>
<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: index.php");   //send user to login page
 
        $login_username = $_GET["id"];
        $login_password;

		function generateRandomString($length = 10) {
			return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
		}

		if (isset($_POST["new_pass"]))
		{
			$login_password = $_POST["new_pass"];
		}
		else
		{
			$login_password = generateRandomString();
		}
 		 
	     require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

	     $sql = "UPDATE login SET login_password = '$login_password' WHERE login_username= '$login_username'";

		 echo "<div class='message_box'>";

	     if (mysqli_query($conn, $sql)) {
			echo "<h1>Password Updated</h1>";
			} else {
				echo "<h1>Error: " . $sql . "<br>" . mysqli_error($conn) . "</h1>";
				}
          mysqli_close($conn);

		  if (!isset($_POST["new_pass"]))
		  {
			echo "<p>The new password for this username (" . "$login_username" . ") is: " . "$login_password" . "</p>";
		  }
		  
		  if (isset($_GET["resetFrom"]))
		  {
			if ($_GET["resetFrom"] == "adminList")
				echo "<div class = 'button_box'><a href='view_admin_list.php'>Click here to view the list of administrators</a></div>";
			else if ($_GET["resetFrom"] == "coorList")
				echo "<div class = 'button_box'><a href='view_coor_list.php'>Click here to view the list of coordinators</a></div>";
			else if ($_GET["resetFrom"] == "studList")
				echo "<div class = 'button_box'><a href='view_student_list.php'>Click here to view the list of students</a></div>";
		  }
		  else
		  {
			echo "<div class = 'button_box'><a href='view_profile.php'>Click here to view the updated profile</a></div>";
		  }
  ?>
  </html>