	<html>
	<head><title>Login</title>
	<link rel="stylesheet" href="style1.css">
	</head>
	<body>
	<?php if (!isset($_COOKIE["remembered_login"])) { ?>
		<div class = "box">
		<h1>Welcome! Please log in before proceeding</h1>
	    
		<form method="post" action="check_login.php">
		<?php if (isset($_GET["login"])) { ?>
		<div class = "warning">
			Invalid username and password.
		</div>
		<?php } ?>
		<div class = "text">
		<input type="text" name="username">
		<span></span>
        <label>Username</label>
		</div>
		<div class = "text"> 
		 <input type="password" name="password">
		<span></span>
          <label>Password</label>
		</div>
		<p><input type="submit" value="Login" /></p>
		</form>
		</div>
	<?php } else { ?>
		<div class = "box">
		<form method="post" action="check_login.php">
			<?php 
				require("config.php");
				$sql;
				$login_username = $_COOKIE["remembered_login"];
				$login_type = $_COOKIE["remembered_login_type"];

				if ($login_type == "Admin")
				{
					$sql = "SELECT * FROM admin WHERE admin_username = '$login_username'";
				}
				else if ($login_type == "Coordinator")
				{
					$sql = "SELECT * FROM coordinator WHERE coor_username = '$login_username'";
				}
				else if ($login_type == "Student")
				{
					$sql = "SELECT * FROM student WHERE stud_username = '$login_username'";
				}

				$query = mysqli_query($conn, $sql);
				$result = mysqli_fetch_assoc($query);
			?>
			<h1>Continue to login as <?php
				if ($login_type == "Admin")
				{
					echo $result["admin_name"];
				}
				else if ($login_type == "Coordinator")
				{
					echo $result["coor_name"];
				}
				else if ($login_type == "Student")
				{
					echo $result["stud_name"];
				}?>?</h1>
			<br/><br/><br/>
			<p><input type="submit" value="Yes"/></p>
			
			<a href = "logout.php">
				No
			</a>
			<br/><br/><br/>
			<br/><br/>
		</div>
		</form>;
	<?php } ?>
		
	</body>
	</html>
	

 