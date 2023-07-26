<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: index.php");   //send user to login page

        
	$ID = $_GET['id'];
		 
	require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp
		 
	// Retrieve data from database
	$sql="SELECT * FROM admin WHERE admin_staff_no='$ID'"; 
	$result = mysqli_query($conn, $sql);
	$rows=mysqli_fetch_assoc($result);

	//Check and Validate the data (retrieve data from database)
	$sql = "SELECT * FROM admin";
    $sql_results = mysqli_query($conn, $sql);
    $adminResults = array();
    while ($row = mysqli_fetch_array($sql_results))
    {
	    array_push($adminResults, $row);
    }
    $js_adminResults = json_encode($adminResults);

    $sql = "SELECT * FROM coordinator";
    $sql_results = mysqli_query($conn, $sql);
    $coordinatorResults = array();
    while ($row = mysqli_fetch_array($sql_results))
    {
	    array_push($coordinatorResults, $row);
    }
    $js_coordinatorResults = json_encode($coordinatorResults);

    $sql = "SELECT * FROM student";
    $sql_results = mysqli_query($conn, $sql);
    $studentResults = array();
    while ($row = mysqli_fetch_array($sql_results))
    {
	    array_push($studentResults, $row);
    }
    $js_studentResults = json_encode($studentResults);


    if ($_SESSION["LEVEL"] == 1) {
?>
	<html>
	<head>
		<title>View Admin Data</title>
		<link rel="stylesheet" href="form_view.css">
        <script>
            function allowUpdateData()
			{
				const inputFields = document.getElementsByTagName("input");
				let id = "<?php echo $ID?>";
				let num = inputFields.length;

				for(let i = 0; i < num - 3; i++)
				{
					if (i != 2)
						inputFields[i].readOnly = false;
				}

				let dynamicButton = document.getElementById("dynamicButton");
				dynamicButton.innerText = "Confirm";
				dynamicButton.onclick = null;
				dynamicButton.onclick = function()
				{
					if (validateAdmin())
						if (confirm("Are you sure you want to update this data?"))
							document.getElementById("form").submit();
				}

				let buttonDiv = document.getElementById("button_group");
				let cancelButton = document.createElement("button");
				let cancelText = document.createTextNode("Cancel");
				cancelButton.append(cancelText);
				cancelButton.type = "button";
				cancelButton.onclick = function()
				{
					if (confirm("Are you sure you want to discard the changes?"))
						location.href = "view_admin.php?id=" + id;
				}
				buttonDiv.append(cancelButton);
			}

			function validateAdmin()
			{

				var adminName = document.adminform.admin_name.value;
				var adminPhone = document.adminform.admin_phone.value;
				var adminIc = document.adminform.admin_ic.value;
				var adminAddress = document.adminform.admin_address.value;
                var adminEmail = document.adminform.admin_email.value;

                var admin_list = <?php echo $js_adminResults ?>;
                var coor_list = <?php echo $js_coordinatorResults ?>;
                var stud_list = <?php echo $js_studentResults ?>;
				
				//Check against admin data
                for(let counter = 0; counter < admin_list.length; counter++)
                {
					//Verified the user ID
					let id = "<?php echo $ID?>";
					if(admin_list[counter].admin_staff_no == id)
					{
						continue;
					}
					else
					{
						//Check for similar IC
						if(adminIc == admin_list[counter].admin_ic)
						{
							alert("IC no. already exists!");
							document.adminform.admin_ic.focus();
							return false;
						}

						//Check for similar email
						if(adminEmail.toUpperCase() == admin_list[counter].admin_email.toUpperCase())
						{
							alert("Email address already exists!");
							document.adminform.admin_email.focus();
							return false;
						}

						//Check for similar phone number
						if(adminPhone == admin_list[counter].admin_phone)
						{
							alert("Phone no. already exists!");
							document.adminform.admin_phone.focus();
							return false;
						}
					}
                }

                //Check against coordinator data
                for(let counter = 0; counter < coor_list.length; counter++)
                {

                    //Check for similar IC
                    if(adminIc == coor_list[counter].coor_ic)
                    {
                        alert("IC no. already exists!");
                        document.adminform.admin_ic.focus();
                        return false;
                    }

                    //Check for similar email
                    if(adminEmail.toUpperCase() == coor_list[counter].coor_email.toUpperCase())
                    {
                        alert("Email address already exists!");
                        document.adminform.admin_email.focus();
                        return false;
                    }

                    //Check for similar phone number
                    if(adminPhone == coor_list[counter].coor_phone)
                    {
                        alert("Phone no. already exists!");
                        document.adminform.admin_phone.focus();
                        return false;
                    }
                }

                //Check against student data
                for(let counter = 0; counter < stud_list.length; counter++)
                {

                    //Check for similar IC
                    if(adminIc == stud_list[counter].stud_ic)
                    {
                        alert("IC no. already exists!");
                        document.adminform.admin_ic.focus();
                        return false;
                    }

                    //Check for similar email
                    if(adminEmail.toUpperCase() == stud_list[counter].stud_email.toUpperCase())
                    {
                        alert("Email address already exists!");
                        document.adminform.admin_email.focus();
                        return false;
                    }

                    //Check for similar phone number
                    if(adminPhone == stud_list[counter].stud_phone)
                    {
                        alert("Phone no. already exists!");
                        document.adminform.admin_phone.focus();
                        return false;
                    }
                }
				



				// check if the value is letter; return true if contains non-letter character
				if( /[^a-zA-Z ]/.test(adminName))
				{
					alert("Name cannot contain number!");
					document.adminform.admin_name.focus();
					return false;
				}

				// check if the value is number only
                if ( isNaN(adminIc))
                {
                    alert("Please provide a proper IC!");
                    document.adminform.admin_ic.focus();
                    return false;               
                }

				// check if the value follow email format, that is: contains @ and .
				if( document.adminform.admin_email.value.indexOf("@") == -1 || document.adminform.admin_email.value.indexOf(".") == -1)
				{
					alert("Invalid email format!! Symbol '@' or '.' not found!");
					document.adminform.admin_email.focus();
					return false;
				}

				// check if the value is number only
				if( isNaN(adminPhone))
				{
					alert("Please provide a proper phone number!");
					document.adminform.admin_phone.focus();
					return false;
				}

				// check if the value contains at least 3 "," , as a proper address format have [housenumber + postalcode + state + countryname]
				if( (adminAddress.match(/,/g)||[]).length < 3)
				{
					alert("Please enter a valid address! The valid address should have at least 3 ','.");
					document.adminform.admin_address.focus();
					return false;
				}

				return true;
			}
        </script>
	<head>
	<body>  
    <div class="form">
        <form class = "input_form" id = "form" method = "post" action="update_admin.php?id=<?php echo $ID;?>&fromList=yes" name="adminform">
			<h1>Administrator's Data</h1>
			<div class = "basic_information">    
				<h2>Basic Information</h2>
				<label for="admin_name">Name: </label>
				<input type="text" id="admin_name" name="admin_name" value="<?php echo $rows['admin_name'] ?>" maxlength="50" readonly><br><br>

				<label for="admin_ic">Identification Card Number(IC): </label>
				<input type="text" id="admin_ic" name="admin_ic" value="<?php echo $rows['admin_ic'] ?>" maxlength="20" readonly><br><br>

				<label for="admin_staff_no">Staff No: </label>
				<input type="text" id="admin_staff_no" name="admin_staff_no" value="<?php echo $rows['admin_staff_no'] ?>" maxlength="10" readonly><br><br>

				<label for="admin_email">Email: </label>
				<input type="text" id="admin_email" name="admin_email" size="30" value="<?php echo $rows['admin_email'] ?>" maxlength="30" readonly><br><br>

				<label for="admin_phone">Phone Number (HP): </label>
				<input type="text" id="admin_phone" name="admin_phone" value="<?php echo $rows['admin_phone'] ?>" maxlength="20" readonly><br><br>

				<label for="admin_address">Address: </label>
				<input type="text" id="admin_address" name="admin_address" value="<?php echo $rows['admin_address'] ?>" maxlength="100" readonly><br>

				<div class="button_group" id ="button_group">
					<button id="dynamicButton" type="button" onclick="allowUpdateData()">Update</button>
				</div>
				<br/><br/>
			</div>

			<div class = "login_information">
				<h2>Login Information</h2>
				<label for="username">Username: </label>
				<input type="text" id="username" name="username" value="<?php echo $rows['admin_username'] ?>" readonly><br><br>
			</div>

			<div class = "button_group">
				<a href="view_admin_list.php"> <input type="button" value="Back"></a>
				<?php if ($rows['admin_staff_no'] != $_SESSION["LOGIN_ADMIN"]) { ?>
				<a class = "right_1" href="delete_admin.php?id=<?php echo $rows['admin_staff_no']?>"> <input type="button" value="Delete" onclick="return confirm('Are you sure you want to delete this administrator?');"></a>
				<?php } ?>
			</div>
        </form>
	</div>
</body>
</html>

  <?php
			 
  mysqli_close($conn);
    
  }
  else {

    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
	 
	echo "<p><a href='main.php'>Back to main page</a></p>";
	
	echo "<p><a href='logout.php'>LOGOUT</a></p>";

  }
?>