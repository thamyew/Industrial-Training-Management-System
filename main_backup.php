<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: index.php");   //send user to login page
?>

<!DOCTYPE html>
<html>
	<head><title>Main Page</title></head>
	<link rel="stylesheet" href="style_main.css">
	</head>
	<body>

	<div class="main">
	<div class="mainpage">
	<h1>Main page</h1>
	</div>
	<div class="menu_container">
 	<?php if ($_SESSION["LEVEL"] == 1) { ?>

		<h1 class="title">Admin Main Page</h1>
		<a href="view_profile.php">My Profile</a> <br/><br/>
		<a href="manage_user_page.php">User Management</a> <br/><br/>
		<a href="view_practical_training_application.php">Application Management</a> <br/><br/>
	<?php } else if ($_SESSION["LEVEL"] == 2) { ?>
		<h1 class="title">Welcome to Coordinator Page</h1>
		<a href="view_profile.php">My Profile</a><br/><br/>
		<a href="view_practical_training_application.php">View Students' Application</a><br/><br/>
	<?php } else { ?>
		<h1 class="title">Welcome to Student Page</h1>
		<a href="view_profile.php">My Profile</a><br/><br/>
		<a href="view_practical_training_application.php">Manage Training Session</a><br/><br/>
	<?php } ?> 
	 
	<a href="logout.php">LOGOUT</a> 
	</div>    
	
	</div>       
	
	</body>
	</html>