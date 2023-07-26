<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: index.php");

require ('config.php');

$ID;

if (isset($_SESSION['LOGIN_ADMIN']))
{
	$ID = $_SESSION['LOGIN_ADMIN'];
	$sql = "SELECT * FROM admin WHERE admin_staff_no='$ID'";
}
else if (isset($_SESSION['LOGIN_COORDINATOR']))
{
	$ID = $_SESSION['LOGIN_COORDINATOR'];
	$sql = "SELECT * FROM coordinator WHERE coor_staff_no='$ID'";
}
else if (isset($_SESSION['LOGIN_STUDENT']))
{
	$ID = $_SESSION['LOGIN_STUDENT'];
	$sql = "SELECT * FROM student WHERE stud_matric_no='$ID'";
}

$query = mysqli_query($conn, $sql);
$rows = mysqli_fetch_assoc($query);

?>
	 	
	<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>My Profile</title>
		<link rel="stylesheet" href="form_view.css">
	<head>
	<body>
	<div class="form">
		<div class="profile">
		<h1>My Profile</h1>

		<?php if ($_SESSION["LEVEL"] == 1) { ?>
			<div class="basic_information">
				<h2>Basic Information</h2>
				<p><b>Name:</b> <?php echo $rows['admin_name']?> </p>
				<p><b>Identification Card Number(IC):</b> <?php echo $rows['admin_ic']?> </p>
				<p><b>Staff No.:</b> <?php echo $rows['admin_staff_no']?> </p>
				<p><b>Email:</b> <?php echo $rows['admin_email']?> </p>
				<p><b>Phone Number (HP):</b> <?php echo $rows['admin_phone']?> </p>
				<p><b>Address:</b> <?php echo $rows['admin_address']?> </p>

				<div class="button_group">
					<a class = "right" href="update_profile_form.php?id=<?php echo $_SESSION['LOGIN_ADMIN']?>">
						<input type="button" value="Edit Basic Information">
					</a>
				</div>
				<br/>
			</div>

			<div class="login_information">
				<h2>Login Information</h2>
				<p><b>Username:</b> <?php echo $rows['admin_username']?> </p>
			
				<div class="button_group">
					<a class = "right" href="update_login_form.php?username=<?php echo $_SESSION["USER"]?>">
						<input type="button" value="Change Password">
					</a>
				</div>
				<br/>
			</div>
				<a href="main.php">
					<input type="button" value="Back">
				</a>
		<?php } else if ($_SESSION["LEVEL"] == 2) { ?>
			<div class="basic_information">
				<h2>Basic Information</h2>
				<p><b>Name:</b> <?php echo $rows['coor_name']?> </p>
				<p><b>Identification Card Number(IC):</b> <?php echo $rows['coor_ic']?> </p>
				<p><b>Staff No.:</b> <?php echo $rows['coor_staff_no']?> </p>
				<p><b>Email:</b> <?php echo $rows['coor_email']?> </p>
				<p><b>Phone Number (HP):</b> <?php echo $rows['coor_phone']?> </p>
				<p><b>Address:</b> <?php echo $rows['coor_address']?> </p>
			
				<div class="button_group">
					<a href="update_profile_form.php?id=<?php echo $_SESSION['LOGIN_COORDINATOR']?>">
						<input type="button" value="Edit Basic Information">
					</a>
				</div>
				<br/>
			</div>

			<div class="login_information">
				<h2>Login Information</h2>
				<p><b>Username:</b> <?php echo $rows['coor_username']?> </p>

				<div class="button_group">
					<a href="update_login_form.php?username=<?php echo $_SESSION["USER"]?>">
						<input type="button" value="Change Password">
					</a>
				</div>
				<br/>
			</div>
				<a href="main.php">
					<input type="button" value="Back">
				</a>
		<?php } else { ?>
			<div class="basic_information">
				<h2>Basic Information</h2>
				<p><b>Name:</b> <?php echo $rows['stud_name']?> </p>
				<p><b>Identification Card Number(IC):</b> <?php echo $rows['stud_ic']?> </p>
				<p><b>Matric No.:</b> <?php echo $rows['stud_matric_no']?> </p>
				<p><b>Email:</b> <?php echo $rows['stud_email']?> </p>
				<p><b>Phone Number (HP):</b> <?php echo $rows['stud_phone']?> </p>
				<p><b>Address:</b> <?php echo $rows['stud_address']?> </p>
				<p><b>Company Enrolled:</b>
				<?php
					$sql = "SELECT * FROM practicalTrainingApplication WHERE stud_matric_no='$ID' AND application_result='Accepted'";
					$query = mysqli_query($conn, $sql);
					
					if (mysqli_num_rows($query) > 0)
					{
						$result = mysqli_fetch_assoc($query);
						echo $result['company_name'];
					}
					else
					{
						echo "-";
					}
				?>
				</p>

				<div class="button_group">
					<a href="update_profile_form.php?id=<?php echo $_SESSION['LOGIN_STUDENT']?>">
						<input type="button" value="Edit Basic Information">
					</a>
				</div>
				<br/>
			</div>

			<div class="login_information">
				<h2>Login Information</h2>
				<p><b>Username:</b> <?php echo $rows['stud_username']?> </p>

				<div class="button_group">
					<a href="update_login_form.php?username=<?php echo $_SESSION["USER"]?>">
						<input type="button" value="Change Password">
					</a>
				</div>
				<br/>
			</div>
			<a href="main.php">
				<input type="button" value="Back">
			</a>
		</div>
	</div>
	<?php } 
	
		mysqli_close($conn);
	?> 
	
		
	</body>
	</html>