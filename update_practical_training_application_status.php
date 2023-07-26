<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: index.php");   //send user to login page
 
if ($_SESSION["LEVEL"] == 2) { 	//only user level 2 can access

?>
	<html>
	<head>
		<title>Update Application Status</title>
		<link rel="stylesheet" href="message.css">
	<head>
	<body>
	
<?php
        
		 $ID = $_GET['id'];
		 $Status = $_GET['status'];
		 $From = $_GET['from'];
		 
		 require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp
		 
	     // Update data from database
		 $sql="UPDATE practicalTrainingApplication 
		 	   SET application_result='$Status'
			   WHERE application_id='$ID'";

		 $result = mysqli_query($conn, $sql);

		 if ($From == 'form')
		 	echo "<div class='message_box_long'>";
		 else
		 	echo "<div class='message_box'>";

		 if ($result)
			echo "<h1>Update Application Status Successfully</h1>";
		 else
		 	echo "<h1>Update Application Status Failed</h1>";

		 if ($From == 'form')
		 	echo "<div class='button_box'><a href='view_practical_training_application_info.php?id=$ID'>Click here to view the updated application</a></div>";

		 echo "<div class='button_box'><a href='view_practical_training_application.php'>Click here to view updated list of applications</a></div>";
		 echo "</div>";
?>



</body>
</html>

<?php	 
	     mysqli_close($conn);
	    
// If the user is not correct level
} else {
	
  echo "<p>Wrong User Level! You are not authorized to view this page</p>";
	  
  echo "<p><a href='main.php'>Go back to main page</a></p>";
  
  echo "<p><a href='logout.php'>LOGOUT</a></p>";
  }
  
?>
 
    	

