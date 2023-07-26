<?php
session_start(); // Start up your PHP Session

// If the user is not logged in send him/her to the login form
if ($_SESSION["Login"] != "YES") 
header("Location: login.php");

if ($_SESSION["LEVEL"] == 1) { 
    
    require_once("config.php");

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
?>


<html>
<head>
    <title>Inserting Coordinator Data</title>
    <link rel="stylesheet" href="form_view.css">

    <script>
            //Validate that the value entered already exists
            function validateCoordinate()
			{
                var coorPassword = document.coorform.coor_password.value;
				var coorName = document.coorform.coor_name.value;
				var coorPhone = document.coorform.coor_phone.value;
                var coorIc = document.coorform.coor_ic.value;
				var coorAddress = document.coorform.coor_address.value;
                var coorUsername = document.coorform.coor_username.value.toUpperCase();
                var coorStaff_no = document.coorform.coor_staff_no.value.toUpperCase();
                var coorEmail = document.coorform.coor_email.value;

                var coor_list = <?php echo $js_coor_results ?>;
                var admin_list = <?php echo $js_adminResults ?>;
                var stud_list = <?php echo $js_studentResults ?>;

                //Check against coordinator data
                for(let counter = 0; counter < coor_list.length; counter++)
                {
                    //Check for similar username
                    if(coorUsername == coor_list[counter].coor_username.toUpperCase())
                    {
                        alert("Username already exists!");
                        document.coorform.coor_username.focus();
                        return false;
                    }

                    //Check for similar IC
                    if(coorIc == coor_list[counter].coor_ic)
                    {
                        alert("IC no. already exists!");
                        document.coorform.coor_ic.focus();
                        return false;
                    }

                    //Check for similar staff number
                    if(coorStaff_no.toUpperCase() == coor_list[counter].coor_staff_no.toUpperCase())
                    {
                        alert("Staff no. already exists!");
                        document.coorform.coor_staff_no.focus();
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

               //Check against admin data
               for(let counter = 0; counter < admin_list.length; counter++)
                {
                    //Check for similar username
                    if(coorUsername == admin_list[counter].admin_username.toUpperCase())
                    {
                        alert("Username already exists!");
                        document.coorform.coor_username.focus();
                        return false;
                    }

                    //Check for similar IC
                    if(coorIc == admin_list[counter].admin_ic)
                    {
                        alert("IC no. already exists!");
                        document.coorform.coor_ic.focus();
                        return false;
                    }
                    
                    //Check for similar staff number
                    if(coorStaff_no.toUpperCase() == admin_list[counter].admin_staff_no.toUpperCase())
                    {
                        alert("Staff no. already exists!");
                        document.coorform.coor_staff_no.focus();
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
                    //Check for similar username
                    if(coorUsername == stud_list[counter].stud_username.toUpperCase())
                    {
                        alert("Username already exists!");
                        document.coorform.coor_username.focus();
                        return false;
                    }

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

                // validate that the size must larger than 5
                if( document.coorform.coor_username.value.length <= 5)
                {
                    alert("Username must more than 5 character!");
                    document.coorform.coor_username.focus();
                    return false;
                }

                // validate that the size must contain special character 
                var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
                if( !format.test(coorPassword))
                {
                    alert("Password must contain special character!");
                    document.coorform.coor_password.focus();
                    return false;
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

                if (!confirm("Are you sure you want to add this coordinator?"))
                {
                    return false;
                }
			}
    </script>
</head>
<body>
    <div class="form">
        <form class="input_form" method = "post" action="insert_coordinator.php" name="coorform" onsubmit="return validateCoordinate()">
            <h1>New Coordinator Form</h1>
            <p>Please fill in the following information:</p>
        
            <div class="login_information">
                <h2>Login Information</h2>

                <label for="coor_username">Username: </label>
                <input type="text" id="coor_username" name="coor_username" maxlength="20" required><br><br>

                <label for="coor_password">Password: </label>
                <input type="password" id="coor_password" name="coor_password" maxlength="20" required><br><br>
            </div>

            <div class="basic_information">
                <h2>Basic Information</h2>
                <label for="coor_name">Name: </label>
                <input type="text" id="coor_name" name="coor_name" maxlength="50" required><br><br>

                <label for="coor_ic">Identification Card Number(IC): </label>
                <input type="text" id="coor_ic" name="coor_ic" maxlength="20" required><br><br>

                <label for="coor_staff_no">Staff No: </label>
                <input type="text" id="coor_staff_no" name="coor_staff_no" maxlength="10" required><br><br>

                <label for="coor_email">Email: </label>
                <input type="text" id="coor_email" name="coor_email" maxlength="30" required><br><br>

                <label for="coor_phone">Phone Number (HP): </label>
                <input type="text" id="coor_phone" name="coor_phone" maxlength="20" required><br><br>

                <label for="coor_address">Address: </label>
                <input type="text" id="coor_address" name="coor_address" maxlength="100" required><br><br>
            </div>
			
            <div class="button_group">
                <input class = "right" type="submit" name="submit" value="Submit">
			    <a href="view_coor_list.php"><input type="button" name="cancel" value="Cancel"></a>
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