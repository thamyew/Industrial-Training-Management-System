<?php
session_start(); // Start up your PHP Session

// If the user is not logged in send him/her to the login form
if ($_SESSION["Login"] != "YES") 
header("Location: login.php");

if ($_SESSION["LEVEL"] == 1) { 
    
    require_once("config.php");

    $sql = "SELECT * FROM student";
    $sql_results = mysqli_query($conn, $sql);
    $studentResults = array();
    while ($row = mysqli_fetch_array($sql_results))
    {
	    array_push($studentResults, $row);
    }
    $js_studentResults = json_encode($studentResults);

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

?>


<html>
<head>
    <title>Inserting Student Data</title>
    <link rel="stylesheet" href="form_view.css">

    <script>
    		function validateStudent()
			{
                var studPassword = document.studform.stud_password.value;
				var studName = document.studform.stud_name.value;
				var studPhone = document.studform.stud_phone.value;
                var studIc = document.studform.stud_ic.value;
				var studAddress = document.studform.stud_address.value;
                var studUsername = document.studform.stud_username.value;
                var studMatric_no = document.studform.stud_matric_no.value;
                var studEmail = document.studform.stud_email.value;
                
                var stud_list = <?php echo $js_studentResults ?>;
                var admin_list = <?php echo $js_adminResults ?>;
                var coor_list = <?php echo $js_coordinatorResults ?>;
                
                //Check against student data
                for(let counter = 0; counter < stud_list.length; counter++)
                {
                    //Check for similar username
                    if(studUsername.toUpperCase() == stud_list[counter].stud_username.toUpperCase())
                    {
                        alert("Username already exists!");
                        document.studform.stud_username.focus();
                        return false;
                    }

                    //Check for similar IC
                    if(studIc == stud_list[counter].stud_ic)
                    {
                        alert("IC no. already exists!");
                        document.studform.stud_ic.focus();
                        return false;
                    }

                    //Check for similar matric no
                    if(studMatric_no.toUpperCase() == stud_list[counter].stud_matric_no.toUpperCase())
                    {
                        alert("Matric no. already exists!");
                        document.studform.stud_matric_no.focus();
                        return false;
                    }

                    //Check for similar email
                    if(studEmail.toUpperCase() == stud_list[counter].stud_email.toUpperCase())
                    {
                        alert("Email address already exists!");
                        document.studform.stud_email.focus();
                        return false;
                    }

                    //Check for similar phone number
                    if(studPhone == stud_list[counter].stud_phone)
                    {
                        alert("Phone no. already exists!");
                        document.studform.stud_phone.focus();
                        return false;
                    }
                }

                //Check against admin data
                for(let counter = 0; counter < admin_list.length; counter++)
                {
                    //Check for similar username
                    if(studUsername.toUpperCase() == admin_list[counter].admin_username.toUpperCase())
                    {
                        alert("Username already exists!");
                        document.studform.stud_username.focus();
                        return false;
                    }

                    //Check for similar IC
                    if(studIc == admin_list[counter].admin_ic)
                    {
                        alert("IC no. already exists!");
                        document.studform.stud_ic.focus();
                        return false;
                    }

                    //Check for similar email
                    if(studEmail.toUpperCase() == admin_list[counter].admin_email.toUpperCase())
                    {
                        alert("Email address already exists!");
                        document.studform.stud_email.focus();
                        return false;
                    }

                    //Check for similar phone number
                    if(studPhone == admin_list[counter].admin_phone)
                    {
                        alert("Phone no. already exists!");
                        document.studform.stud_phone.focus();
                        return false;
                    }
                }

                //Check against coordinator data
                for(let counter = 0; counter < coor_list.length; counter++)
                {
                    //Check for similar username
                    if(studUsername.toUpperCase() == coor_list[counter].coor_username.toUpperCase())
                    {
                        alert("Username already exists!");
                        document.studform.stud_username.focus();
                        return false;
                    }

                    //Check for similar IC
                    if(studIc == coor_list[counter].coor_ic)
                    {
                        alert("IC no. already exists!");
                        document.studform.stud_ic.focus();
                        return false;
                    }

                    //Check for similar email
                    if(studEmail.toUpperCase() == coor_list[counter].coor_email.toUpperCase())
                    {
                        alert("Email address already exists!");
                        document.studform.stud_email.focus();
                        return false;
                    }

                    //Check for similar phone number
                    if(studPhone == coor_list[counter].coor_phone)
                    {
                        alert("Phone no. already exists!");
                        document.studform.stud_phone.focus();
                        return false;
                    }
                }

                // validate that the size must larger than 5
                if( document.studform.stud_username.value.length <= 5)
                {
                    alert("Username must more than 5 character!");
                    document.studform.stud_username.focus();
                    return false;
                }

                // validate that the size must contain special character 
                var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
                if( !format.test(studPassword))
                {
                    alert("Password must contain special character!");
                    document.studform.stud_password.focus();
                    return false;
                }

				// check if the value is letter; return true if contains non-letter character
				if( /[^a-zA-Z ]/.test(studName))
				{
					alert("Name cannot contain number!");
					document.studform.stud_name.focus();
					return false;
				}

                // check if the value is number only
                if ( isNaN(studIc))
                {
                    alert("Please provide a proper IC!");
                    document.studform.stud_ic.focus();
                    return false;               
                }

				// check if the value follow email format, that is: contains @ and .
				if( document.studform.stud_email.value.indexOf("@") == -1 || document.studform.stud_email.value.indexOf(".") == -1)
				{
					alert("Invalid email format!! Symbol '@' or '.' not found!");
					document.studform.stud_email.focus();
					return false;
				}

				// check if the value is number only
				if( isNaN(studPhone))
				{
					alert("Please provide a proper phone number!");
					document.studform.stud_phone.focus();
					return false;
				}                
				

				// check if the value contains at least 3 "," , as a proper address format have [housenumber + postalcode + state + countryname]
				if( (studAddress.match(/,/g)||[]).length < 3)
				{
					alert("Please enter a valid address! The valid address should have at least 3 ','.");
					document.studform.stud_address.focus();
					return false;
				}

                if (!confirm("Are you sure you want to add this student?"))
                {
                    return false;
                }
			}
    </script>
</head>
<body>
    <div class="form">
        <form class="input_form" method = "post" action="insert_student.php" name="studform" onsubmit="return validateStudent()">
            <h1>New Student Form</h1>
            <p>Please fill in the following information:</p>
            
            <div class="login_information">
                <h2>Login Information</h2>

                <label for="stud_username">Username: </label>
                <input type="text" id="stud_username" name="stud_username" maxlength="20" required><br><br>

                <label for="stud_password">Password: </label>
                <input type="password" id="stud_password" name="stud_password" maxlength="20" required><br><br>
            </div>

            <div class="basic_information">
                <h2>Basic Information</h2>
                <label for="stud_name">Name: </label>
                <input type="text" id="stud_name" name="stud_name" maxlength="50" required><br><br>

                <label for="stud_ic">Identification Card Number(IC): </label>
                <input type="text" id="stud_ic" name="stud_ic" maxlength="20" required><br><br>

                <label for="stud_matric_no">Matric No: </label>
                <input type="text" id="stud_matric_no" name="stud_matric_no" maxlength="10" required><br><br>

                <label for="stud_email">Email: </label>
                <input type="text" id="stud_email" name="stud_email" maxlength="30" required><br><br>

                <label for="stud_phone">Phone Number (HP): </label>
                <input type="text" id="stud_phone" name="stud_phone" maxlength="20" required><br><br>

                <label for="stud_address">Address: </label>
                <input type="text" id="stud_address" name="stud_address" maxlength="100" required><br><br>
            </div>

            <div class="button_group">
                <input class = "right" type="submit" name="submit" value="Submit">
                <a href="view_student_list.php"><input type="button" name="cancel" value="Cancel"></a>
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