<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: index.php");

if ($_SESSION["LEVEL"] == 1) {   //only user with access level 1 can view

?>
	 	
	<html>
	<head><title>Manage Coordinator Data</title><head>
	<link rel="stylesheet" href="style1.css">
	<body>
	
	<div class="main">
	<h1 class="title">View Coordinator List</h1>
	</div>
	
		<?php

		 $search_name;
		 $search_staff_no;

		 if (isset($_GET["search_name"]))
		 {
			$search_name = $_GET["search_name"];
		 }

		 if (isset($_GET["search_staff_no"]))
		 {
			$search_staff_no = $_GET["search_staff_no"];
		 }

	     require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

		 if (isset($_GET["search_name"]) and isset($_GET["search_staff_no"]))
		 {
			$sql = "SELECT * FROM coordinator WHERE coor_name LIKE '%$search_name%' and coor_staff_no LIKE '%$search_staff_no%'";
		 }
		 else if (isset($_GET["search_name"]))
		 {
			$sql = "SELECT * FROM coordinator WHERE coor_name LIKE '%$search_name%'";
		 }
		 else if (isset($_GET["search_staff_no"]))
		 {
			$sql = "SELECT * FROM coordinator WHERE coor_staff_no LIKE '%$search_staff_no%'";
		 }
		 else
		 {
			$sql = "SELECT * FROM coordinator";
		 }

		 $result = mysqli_query($conn, $sql);

		 if (!$result) die("SQL query error encountered :".mysqli_error() ); ?>

		<div class="search">
		<form name = 'search_name_form' method = "GET" action = "view_coor_list.php">
		 	<input type="text" name="search_name" size="20" placeholder="Search by name...">
			<input type="text" name="search_staff_no" size="20" maxlength="10" placeholder="Search by staff number...">
			<input type = "submit" value = "Search">
		 </form>
		</div>
	
		 <?php if (mysqli_num_rows($result) > 0) { 	?>

		<!-- Start table tag -->
		<table width="600" border="1" cellspacing="0" cellpadding="3">
		 
		<!-- Print table heading -->
		<thead>
		<tr>
		<td align="center"><strong>Staff No.</strong></td>
		<td align="center"><strong>Name</strong></td>
		<td align="center"><strong>IC</strong></td>
		
		<td align="center"><strong>View</strong></td>
		<td align="center"><strong>Delete</strong></td>
		<td align="center"><strong>Reset Password</strong></td>
		
		</tr> 
		 </thead>
		
		<?php
			// output data of each row
			while($rows = mysqli_fetch_assoc($result)) {
		?>
		
	     <tr>
			<td><?php echo $rows['coor_staff_no']; ?></td>
			<td><?php echo $rows['coor_name']; ?></td>
			<td><?php echo $rows['coor_ic']; ?></td>
			

			<!--only user with access level 1 can view update and delete button-->
			<td align="center"> <a href="view_coor.php?id=<?php echo $rows['coor_staff_no']; ?>"><img src ='Icons/search.svg' width = "15px"></a> </td>
			<td align="center"> <a href="delete_coordinator.php?id=<?php echo $rows['coor_staff_no'];?>" onclick="return confirm('Are you sure you want to delete this coordinator?');"><img src = 'Icons/delete.svg' width = '15px'></a> </td>
			<td align="center"> <a href="update_login.php?id=<?php echo $rows['coor_username'];?>&resetFrom=coorList" onclick="return confirm('Are you sure you want to reset the password of this coordinator?');"><img src ='Icons/reset.svg' width="15px"></a> </td>
		</tr> 
		
		<?php 
		
			}
		} else {
			echo "<h3 style='text-align:center;'>There are no records to show.</h3>";
			}

	     mysqli_close($conn);
	   ?>
	    </table>
		
		<div class="main">
		<br><br>
		<a href="coor_form.php">Click here to insert coordinator</a>
		<br><br>
		<a href="manage_user_page.php">Manage Other Users</a>
		<br/><br/>
		<a href="main.php">Back to Main Menu</a>
		<br/><br/>
	    <a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">LOGOUT</a>
 
 	<?php } // If the user is not correct level
	else {
	
	echo "<p>Wrong User Level! You are not authorized to view this page</p>";
	 
	echo "<p><a href='main.php'>Back to main page</a></p>";
	
	echo "<p><a href='logout.php'>LOGOUT</a></p>";
 
   }
 
  ?>
    </div>
	</body>
	</html>