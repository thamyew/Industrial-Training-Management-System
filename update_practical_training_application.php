<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: index.php");   //send user to login page
 
if ($_SESSION["LEVEL"] != 2) { 	//only user level 2 can access

?>
	<html>
	<head>
		<title>Update Application Data</title>
		<link rel="stylesheet" href="message.css">
	<head>
	<body>
	
<?php
        
		 $application_id = $_POST['application_id'];
		 $stud_matric_no = $_POST['stud_matric_no'];
		 $company_name = $_POST['company_name'];
		 $company_address = $_POST['company_address'];
		 $company_phone = $_POST['company_phone'];
		 $company_email = $_POST['company_email'];
		 $training_startdate = $_POST['training_startdate'];
		 $training_enddate = $_POST['training_enddate'];
		 $application_result = $_POST['application_result'];

		 require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp
		 
	     // Update data from database
		 $sql="UPDATE practicalTrainingApplication
		 	   SET stud_matric_no='$stud_matric_no',
				   company_name='$company_name',
				   company_address='$company_address',
				   company_phone='$company_phone',
				   company_email='$company_email',
				   training_startdate='$training_startdate',
				   training_enddate='$training_enddate',
				   application_result='$application_result'
			   WHERE application_id='$application_id'";

		 $result = mysqli_query($conn, $sql);

		 echo "<div class='message_box_long'>";

		 if ($result)
			echo "<h1>Update Application Successfully</h1>";
		 else
		 	echo "<h1>Update Application Failed</h1>";

		 echo "<div class='button_box'><a href='view_practical_training_application_info.php?id=$application_id'>Click here to view the updated application</a></div>";
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
 
    	

