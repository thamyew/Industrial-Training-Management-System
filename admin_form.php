<?php
session_start(); // Start up your PHP Session

// If the user is not logged in send him/her to the login form
if ($_SESSION["Login"] != "YES") 
header("Location: login.php");

if ($_SESSION["LEVEL"] == 1) { 

    require_once("config.php");

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
?>


<html>
<head>
    <title>Inserting Administrator Data</title>
    <link rel="stylesheet" href="form_view.css">

    <script>

           //Validate that the value entered already exists
			function validateAdmin()
			{
                var adminPassword = document.adminform.admin_password.value;
				var adminName = document.adminform.admin_name.value;
				var adminPhone = document.adminform.admin_phone.value;
                var adminIc = document.adminform.admin_ic.value;
				var adminAddress = document.adminform.admin_address.value;
                var adminUsername = document.adminform.admin_username.value.toUpperCase();
                var adminStaff_no = document.adminform.admin_staff_no.value.toUpperCase();
                var adminEmail = document.adminform.admin_email.value;

                var admin_list = <?php echo $js_adminResults ?>;
                var coor_list = <?php echo $js_coordinatorResults ?>;
                var stud_list = <?php echo $js_studentResults ?>;
                
                //Check against admin data
                for(let counter = 0; counter < admin_list.length; counter++)
                {
                    //Check for similar username
                    if(adminUsername == admin_list[counter].admin_username.toUpperCase())
                    {
                        alert("Username already exists!");
                        document.adminform.admin_username.focus();
                        return false;
                    }

                    //Check for similar IC
                    if(adminIc == admin_list[counter].admin_ic)
                    {
                        alert("IC no. already exists!");
                        document.adminform.admin_ic.focus();
                        return false;
                    }
                    
                    //Check for similar staff number
                    if(adminStaff_no.toUpperCase() == admin_list[counter].admin_staff_no.toUpperCase())
                    {
                        alert("Staff no. already exists!");
                        document.adminform.admin_staff_no.focus();
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

                //Check against coordinator data
                for(let counter = 0; counter < coor_list.length; counter++)
                {
                    //Check for similar username
                    if(adminUsername == coor_list[counter].coor_username.toUpperCase())
                    {
                        alert("Username already exists!");
                        document.adminform.admin_username.focus();
                        return false;
                    }

                    //Check for similar IC
                    if(adminIc == coor_list[counter].coor_ic)
                    {
                        alert("IC no. already exists!");
                        document.adminform.admin_ic.focus();
                        return false;
                    }

                    //Check for similar staff number
                    if(adminStaff_no.toUpperCase() == coor_list[counter].coor_staff_no.toUpperCase())
                    {
                        alert("Staff no. already exists!");
                        document.adminform.admin_staff_no.focus();
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
                    //Check for similar username
                    if(adminUsername == stud_list[counter].stud_username.toUpperCase())
                    {
                        alert("Username already exists!");
                        document.adminform.admin_username.focus();
                        return false;
                    }

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


                // validate that the size must larger than 5
                if( document.adminform.admin_username.value.length <= 5)
                {
                    alert("Username must more than 5 character!");
                    document.adminform.admin_username.focus();
                    return false;
                }

                // validate that the size must contain special character 
                var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
                if( !format.test(adminPassword))
                {
                    alert("Password must contain special character!");
                    document.adminform.admin_password.focus();
                    return false;
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
                
                if (!confirm("Are you sure you want to add this administrator?"))
                {
                    return false;
                }
			}
    </script>
</head>
<body>
    <div class="form">
        <form class="input_form" method = "post" action="insert_admin.php" name="adminform" onsubmit="return validateAdmin()">
            <h1>New Administrator Form</h1>
            <p>Please fill in the following information:</p>
            <div class="login_information">
                <h2>Login Information</h2>

                <label for="admin_username">Username: </label>
                <input type="text" id="admin_username" name="admin_username" maxlength="20" required><br><br>

                <label for="admin_password">Password: </label>
                <input type="password" id="admin_password" name="admin_password" maxlength="20" required><br><br>
            </div>

            <div class="basic_information">
                <h2>Basic Information</h2>
                <label for="admin_name">Name: </label>
                <input type="text" id="admin_name" name="admin_name" maxlength="50" required><br><br>

                <label for="admin_ic">Identification Card Number(IC): </label>
                <input type="text" id="admin_ic" name="admin_ic" maxlength="20" required><br><br>

                <label for="admin_staff_no">Staff No: </label>
                <input type="text" id="admin_staff_no" name="admin_staff_no" maxlength="10" required><br><br>

                <label for="admin_email">Email: </label>
                <input type="text" id="admin_email" name="admin_email" maxlength="30" required><br><br>

                <label for="admin_phone">Phone Number (HP): </label>
                <input type="text" id="admin_phone" name="admin_phone" maxlength="20" required><br><br>

                <label for="admin_address">Address: </label>
                <input type="text" id="admin_address" name="admin_address" maxlength="100" required><br><br>
            </div>
            
            <div class = "button_group">
                <input class = "right" type="submit" name="submit" value="Submit">
                <a href="view_admin_list.php"><input type="button" name="cancel" value="Cancel"></a>
            </div>
        </form>

    </div>
	</body>
	</html>


<?php 
// If the user is not correct level
} else if ($_SESSION["LEVEL"] != 1) {
	
  echo "<p>Wrong User Level! You are not authorized to view this page</p>";
 
  echo "<p><a href='main.php'>Go back to main page</a></p>";
  
  echo "<p><a href='logout.php'>LOGOUT</a></p>";}