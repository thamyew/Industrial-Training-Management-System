<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: index.php");   //send user to login page
?>

<html>
	<head><title>Main Page</title>
	<link rel="stylesheet" href="style1.css">
	</head>
	<body>

	<div class="main">
		
 	<?php if ($_SESSION["LEVEL"] == 1) { ?>
		<h1 class="title">Admin Main Page</h1>
		<a href="view_profile.php">My Profile</a> <br/><br/>
		<a href="manage_user_page.php">User Management</a> <br/><br/>
		<a href="view_practical_training_application.php">Application Management</a> <br/><br/>
	<?php } else if ($_SESSION["LEVEL"] == 2) { ?>
		<h1 class="title"> Coordinator Main Page</h1>
		<a href="view_profile.php">My Profile</a><br/><br/>
		<a href="view_practical_training_application.php">View Students' Application</a><br/><br/>
	<?php } else { ?>
		<h1 class="title">Student Main Page</h1>
		<a href="view_profile.php">My Profile</a><br/><br/>
		<a href="view_practical_training_application.php">Manage Training Session</a><br/><br/>
	<?php } ?> 
	 
	<a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">LOGOUT</a> 
	
	</div>
	
	</body>
	</html>