<!DOCTYPE html>
<html>
	<head>
		<title>Update Coordinator Data</title>
		<link rel="stylesheet" href="message.css">
	</head>
<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: index.php");   //send user to login page
 
if ($_SESSION["LEVEL"] != 3) { 	//only user level 1 and level 3 can access

         $coor_staff_no = $_POST["coor_staff_no"];
         $coor_ic = $_POST["coor_ic"];
         $coor_name = $_POST["coor_name"];
         $coor_address = $_POST["coor_address"];
         $coor_phone = $_POST["coor_phone"];
         $coor_email = $_POST["coor_email"];		 
 		 
	     require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

	     $sql = "UPDATE coordinator SET coor_ic = '$coor_ic', coor_name = '$coor_name', coor_address = '$coor_address' , coor_phone = '$coor_phone', coor_email = '$coor_email' WHERE coor_staff_no = '$coor_staff_no'" ;

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
         echo "<div class = 'button_box'><a href='view_coor.php?id=$coor_staff_no'>Click here to view updated coordinator data</a></div>";
         echo "<div class = 'button_box'><a href='view_coor_list.php'>Click here to view updated list of coordinators</a></div>";
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