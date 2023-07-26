<!DOCTYPE html>
<html>
	<head>
		<title>Update Administrator Data</title>
		<link rel="stylesheet" href="message.css">
	</head>
<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: index.php");   //send user to login page
 
if ($_SESSION["LEVEL"] == 1) { 	//only user level 1 can access

    $admin_staff_no = $_POST["admin_staff_no"];
    $admin_ic = $_POST["admin_ic"];
    $admin_name = $_POST["admin_name"];
    $admin_address = $_POST["admin_address"];
    $admin_phone = $_POST["admin_phone"];
    $admin_email = $_POST["admin_email"];
		 
 		 
	     require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

	     $sql = "UPDATE admin SET admin_ic = '$admin_ic', admin_name = '$admin_name', admin_address = '$admin_address' , admin_phone = '$admin_phone', admin_email = '$admin_email' WHERE admin_staff_no = '$admin_staff_no'" ;
       
       if (isset($_GET["fromList"]))
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
         
        if (isset($_GET["fromList"]))
        {
          echo "<div class = 'button_box'><a href='view_admin.php?id=$admin_staff_no'>Click here to view updated administrator data</a></div>";
          echo "<div class = 'button_box'><a href='view_admin_list.php'>Click here to view updated list of administrators</a></div>";
        }
        else
        {
          echo "<div class = 'button_box'><a href='view_profile.php'>Click here to view the updated profile</a></div>";
        }  

        echo "</div>";
	  
// If the user is not correct level
} else if ($_SESSION["LEVEL"] != 1) {
	
  echo "<p>Wrong User Level! You are not authorized to view this page</p>";
	 
  echo "<p><a href='main.php'>Go back to main page</a></p>";
  
  echo "<p><a href='logout.php'>LOGOUT</a></p>";
 
   }
 
  ?>
</head>