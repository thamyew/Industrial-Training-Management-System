<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: index.php");

if ($_SESSION["LEVEL"] == 1) {   //only user with access level 1 can view

?>

<html>
    
<header>
    <title>User Management</title>
    <link rel="stylesheet" href="style1.css">
</header>
<body>
<div class="main">
<h1 class="title">User Management Page</h1>
    <a href="view_admin_list.php">Manage Administrators</a> <br/><br/>
	<a href="view_coor_list.php">Manage Coordinators</a> <br/><br/>
	<a href="view_student_list.php">Manage Students</a> <br/><br/>
    <a href="main.php">Back to Main Menu</a> <br/><br/>
    <a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">LOGOUT</a>
</div>
</body>
</html>

<?php } ?>