<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: index.php");   //send user to login page

        
	$ID = $_GET['id'];
		 
	require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp
		 
	// Retrieve data from database
	$sql="SELECT * FROM coordinator WHERE coor_staff_no='$ID'"; 
	$result = mysqli_query($conn, $sql);
	$rows=mysqli_fetch_assoc($result);

	//Validate the existence of data (retrieve data from the database)
	$coor_sql = "SELECT * FROM coordinator";
    $coor_sql_results = mysqli_query($conn, $coor_sql);
    $coor_results = array();
    while ($row = mysqli_fetch_array($coor_sql_results))
    {
	    array_push($coor_results, $row);
    }
    $js_coor_results = json_encode($coor_results);
    
    $sql = "SELECT * FROM admin";
    $sql_results = mysqli_query($conn, $sql);
    $adminResults = array();
    while ($row = mysqli_fetch_array($sql_results))
    {
	    array_push($adminResults, $row);
    }
    $js_adminResults = json_encode($adminResults);

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
		<title>View Coordinator Data</title>
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
					if (validateCoordinate())
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
						location.href = "view_coor.php?id=" + id;
				}
				buttonDiv.append(cancelButton);
			}

			function validateCoordinate()
			{
				var coorName = document.coorform.coor_name.value;
				var coorPhone = document.coorform.coor_phone.value;
				var coorIc = document.coorform.coor_ic.value;
				var coorAddress = document.coorform.coor_address.value;
				var coorEmail = document.coorform.coor_email.value;

                var coor_list = <?php echo $js_coor_results ?>;
                var admin_list = <?php echo $js_adminResults ?>;
                var stud_list = <?php echo $js_studentResults ?>;

                //Check against coordinator data
                for(let counter = 0; counter < coor_list.length; counter++)
                {
                    //Verified the user ID
					let id = "<?php echo $ID?>";
					if(coor_list[counter].coor_staff_no == id)
					{
						continue;
					}
					else
					{
                    //Check for similar IC
                    if(coorIc == coor_list[counter].coor_ic)
                    {
                        alert("IC no. already exists!");
                        document.coorform.coor_ic.focus();
                        return false;
                    }

                    //Check for similar email
                    if(coorEmail.toUpperCase() == coor_list[counter].coor_email.toUpperCase())
                    {
                        alert("Email address already exists!");
                        document.coorform.coor_email.focus();
                        return false;
                    }

                    //Check for similar phone number
                    if(coorPhone == coor_list[counter].coor_phone)
                    {
                        alert("Phone no. already exists!");
                        document.coorform.coor_phone.focus();
                        return false;
                    }
					}
                }

               //Check against admin data
               for(let counter = 0; counter < admin_list.length; counter++)
                {
                    //Check for similar IC
                    if(coorIc == admin_list[counter].admin_ic)
                    {
                        alert("IC no. already exists!");
                        document.coorform.coor_ic.focus();
                        return false;
                    }

                    //Check for similar email
                    if(coorEmail.toUpperCase() == admin_list[counter].admin_email.toUpperCase())
                    {
                        alert("Email address already exists!");
                        document.coorform.coor_email.focus();
                        return false;
                    }

                    //Check for similar phone number
                    if(coorPhone == admin_list[counter].admin_phone)
                    {
                        alert("Phone no. already exists!");
                        document.coorform.coor_phone.focus();
                        return false;
                    }
                }

                //Check against student data
                for(let counter = 0; counter < stud_list.length; counter++)
                {
                    //Check for similar IC
                    if(coorIc == stud_list[counter].stud_ic)
                    {
                        alert("IC no. already exists!");
                        document.coorform.coor_ic.focus();
                        return false;
                    }

                    //Check for similar email
                    if(coorEmail.toUpperCase() == stud_list[counter].stud_email.toUpperCase())
                    {
                        alert("Email address already exists!");
                        document.coorform.coor_email.focus();
                        return false;
                    }

                    //Check for similar phone number
                    if(coorPhone == stud_list[counter].stud_phone)
                    {
                        alert("Phone no. already exists!");
                        document.coorform.coor_phone.focus();
                        return false;
                    }
                }

				// check if the value is letter; return true if contains non-letter character
				if( /[^a-zA-Z ]/.test(coorName))
				{
					alert("Name cannot contain number!");
					document.coorform.coor_name.focus();
					return false;
				}

				// check if the value is number only
                if ( isNaN(coorIc))
                {
                    alert("Please provide a proper IC!");
                    document.coorform.coor_ic.focus();
                    return false;               
                }

				// check if the value follow email format, that is: contains @ and .
				if( document.coorform.coor_email.value.indexOf("@") == -1 || document.coorform.coor_email.value.indexOf(".") == -1)
				{
					alert("Invalid email format!! Symbol '@' or '.' not found!");
					document.coorform.coor_email.focus();
					return false;
				}

				// check if the value is number only
				if( isNaN(coorPhone))
				{
					alert("Please provide a proper phone number!");
					document.coorform.coor_phone.focus();
					return false;
				}          
				
				// check if the value contains at least 3 "," , as a proper address format have [housenumber + postalcode + state + countryname]
				if( (coorAddress.match(/,/g)||[]).length < 3)
				{
					alert("Please enter a valid address! The valid address should have at least 3 ','.");
					document.coorform.coor_address.focus();
					return false;
				}

				return true;
			}
        </script>
	<head>
	<body>    
    <div class ="form">
        <form class = "input_form" id = "form" method = "post" action="update_coor.php?id=<?php echo $ID;?>" name="coorform">
			<h1>Coordinator's Data</h1>
			<div class="basic_information">
				<h2>Basic Information</h2>
				<label for="coor_name">Name: </label>
				<input type="text" id="coor_name" name="coor_name" value="<?php echo $rows['coor_name'] ?>" maxlength="50" readonly><br><br>

				<label for="coor_ic">Identification Card Number(IC): </label>
				<input type="text" id="coor_ic" name="coor_ic" value="<?php echo $rows['coor_ic'] ?>" maxlength="20" readonly><br><br>

				<label for="coor_staff_no">Staff No: </label>
				<input type="text" id="coor_staff_no" name="coor_staff_no" value="<?php echo $rows['coor_staff_no'] ?>" maxlength="10" readonly><br><br>

				<label for="coor_email">Email: </label>
				<input type="text" id="coor_email" name="coor_email" size="30" value="<?php echo $rows['coor_email'] ?>" maxlength="30" readonly><br><br>

				<label for="coor_phone">Phone Number (HP): </label>
				<input type="text" id="coor_phone" name="coor_phone" value="<?php echo $rows['coor_phone'] ?>" maxlength="20" readonly><br><br>

				<label for="coor_address">Address: </label>
				<input type="text" id="coor_address" name="coor_address" value="<?php echo $rows['coor_address'] ?>" maxlength="100" readonly><br>

				<div class="button_group" id ="button_group">
					<button id="dynamicButton" type="button" onclick="allowUpdateData()">Update</button>
				</div>
				<br/><br/>
			</div>

			<div class = "login_information">
				<h2>Login Information</h2>
				<label for="username">Username: </label>
				<input type="text" id="username" name="username" value="<?php echo $rows['coor_username'] ?>" readonly><br><br>
			</div>

			<div class = "button_group">
				<a href="view_coor_list.php"> <input type="button" value="Back"></a>
				<a class = "right_1" href="delete_coordinator.php?id=<?php echo $rows['coor_staff_no']?>"> <input type="button" value="Delete" onclick="return confirm('Are you sure you want to delete this coordinator?');"></a>
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
 