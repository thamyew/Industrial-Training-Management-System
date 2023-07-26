<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: index.php");

?>
	
	<html>
	<head><title>Viewing Application Data</title><head>
	<link rel="stylesheet" href="style1.css">
	<body>
	
	<div class="main">
	<h1 class="title">View Practical Training Application Data</h1>
	</div>
	 
		<?php
	     require("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp

	     if ($_SESSION["LEVEL"] != 3)
		 {
			$sql = "SELECT * FROM practicalTrainingApplication JOIN student ON practicalTrainingApplication.stud_matric_no = student.stud_matric_no ORDER BY student.stud_name";
		 }
		 else
		 {
			$stud_matric = $_SESSION['LOGIN_STUDENT'];
			$sql = "SELECT * FROM practicalTrainingApplication JOIN student ON practicalTrainingApplication.stud_matric_no = student.stud_matric_no WHERE student.stud_matric_no='$stud_matric' ORDER BY student.stud_name";
		 }

		 $result = mysqli_query($conn, $sql); 
		
		 if (mysqli_num_rows($result) > 0) { ?>
					
		<table width="600">
		 
		<thead>
		<tr>
		<th>No</th>
		<th>Name of the Student Applied</th>
		<th>Company Name</th>

		<?php if ($_SESSION["LEVEL"] == 1) {?>
		<th>View</th>
		<th>Result</th>
		<th>Delete</th>
		<?php 
		} else if ($_SESSION["LEVEL"] == 2) {?>
		<th>View</th>
		<th>Result</th>
		<th colspan = "2"><strong>Action</th>
		<?php 
		} else if ($_SESSION["LEVEL"] == 3) {?>
		<th>View</th>
		<th>Result</th>
		<th>Delete</th>
		<?php } ?>

		</tr>
		</thead>
		<?php			
				
		// display num value in the list
		$num = 1;

		// output data of each row
		while($rows = mysqli_fetch_assoc($result)) {
		 
		?>
		
	     <tr>
			<td><?php echo $num; ?></td>
			<td>
				<?php 
					echo $rows['stud_name'];
				?>
			</td>

			<td><?php echo $rows['company_name']; ?></td>

			<td align="center"> <a href="view_practical_training_application_info.php?id=<?php echo $rows['application_id']; ?>"><img src ='Icons/search.svg' width = "15px"></a></a> </td>
			<td align="center"> <?php echo $rows['application_result']; ?> </td>

			<?php if ($_SESSION["LEVEL"] == 1) { ?>
			<td align="center"> <a href="delete_practical_training_application.php?id=<?php echo $rows['application_id']; ?>"  onclick="return confirm('Are you sure you want to delete this application?');"><img src = 'Icons/delete.svg' width = '15px'></a> </td>
			
			<?php 
			} else if ($_SESSION["LEVEL"] == 2) { ?>
			<td align="center"> <a href="update_practical_training_application_status.php?id=<?php echo $rows['application_id'];?>&status=Accepted&from=list" onclick="return confirm('Are you sure you want to accept this application?');"><img src = 'Icons/accept.svg' width = "15px" style = "color: green"></a> </td>
			<td align="center"> <a href="update_practical_training_application_status.php?id=<?php echo $rows['application_id'];?>&status=Rejected&from=list" onclick="return confirm('Are you sure you want to reject this application?');"><img src = 'Icons/reject.svg' width = "15px"></a> </td>
			<?php } else { ?> <td align="center"> 
			<?php if ($rows['application_result'] == "In Review") { ?>
				 <a href="delete_practical_training_application.php?id=<?php echo $rows['application_id']; ?>" onclick="return confirm('Are you sure you want to delete this application?');"><img src = 'Icons/delete.svg' width = '15px'></a>
			<?php } } ?>
			</td>
		</tr>

		<!-- increment the no. by 1 -->
		<?php $num++; ?>

	<?php }
		
			}
		else {
			echo "<h3 style='text-align:center;'>There are no records to show</h3>";
			}

	     mysqli_close($conn);
	   ?>
	    
	    </table>
		<div class="main">
<?php 	
		
	if ($_SESSION["LEVEL"] != 2) {?>
	<br/><br/>
	<a href="practical_training_application_form.php">Insert More Application</a><?php } ?>  

	<br/><br/>
	<a href="view_practical_training_application_companynamesorted.php">
		Sort By Company
	</a>

	<br/><br/>
	<a href="main.php">Back</a>

	<br/><br/>
	<a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">LOGOUT</a>
	</div>