<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: index.php");   //send user to login page
        
     $ID = $_GET['id'];
		 
	 require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp
		 
	 // Retrieve data from database
     $sql;

	 if ($_SESSION["LEVEL"] == 1)
     {
        $sql="SELECT * FROM admin WHERE admin_staff_no='$ID'"; 
        $adminId = $ID;
     }
     else if ($_SESSION["LEVEL"] == 2)
     {
        $sql="SELECT * FROM coordinator WHERE coor_staff_no='$ID'";
        $coorId = $ID;
     }
     else 
     {
        $sql="SELECT * FROM student WHERE stud_matric_no='$ID'";
        $studId = $ID; 
     }

	 $result = mysqli_query($conn, $sql);

	 if (!$result) die("SQL query error encountered :".mysqli_error() );
		 
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

?>
	<html>
	<head>
		<title>Updating Profile</title>
        <link rel="stylesheet" href="form_view.css">
        <script>
            function validateAdmin()
            {
                var adminName = document.adminform.admin_name.value;
                var adminPhone = document.adminform.admin_phone.value;
                var adminAddress = document.adminform.admin_address.value;
                // document.write(cName + "is" + cPhone);
                var adminEmail = document.adminform.admin_email.value;

                var admin_list = <?php echo $js_adminResults?>;
                var coor_list = <?php echo $js_coordinatorResults ?>;
                var stud_list = <?php echo $js_studentResults ?>;

                //Verified the user ID
				let id = "<?php if (isset($adminId)) echo $adminId?>";

                //Check against admin data
                for(let counter = 0; counter < admin_list.length; counter++)
                {
					if(admin_list[counter].admin_staff_no == id)
					{
						continue;
					}
					else
					{
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
                    alert("Please enter a valid address!");
                    document.adminform.admin_address.focus();
                    return false;
                }

                if (!confirm('Are you sure you want to update your profile?'))
                {
                    return false;
                }
            }

            function validateCoordinator()
            {
                var coorName = document.coorform.coor_name.value;
                var coorPhone = document.coorform.coor_phone.value;
                var coorAddress = document.coorform.coor_address.value;
                // document.write(cName + "is" + cPhone);
                var coorEmail = document.coorform.coor_email.value;

                var admin_list = <?php echo $js_adminResults?>;
                var coor_list = <?php echo $js_coordinatorResults ?>;
                var stud_list = <?php echo $js_studentResults ?>;

                //Verified the user ID
				let id = "<?php if (isset($coorId)) echo $coorId?>";

                //Check against coordinator data
                for(let counter = 0; counter < coor_list.length; counter++)
                {
					if(coor_list[counter].coor_staff_no == id)
					{
						continue;
					}
					else
					{
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
                    alert("Please enter a valid address!");
                    document.coorform.coor_address.focus();
                    return false;
                }

                if (!confirm('Are you sure you want to update your profile?'))
                {
                    return false;
                }
            }

            function validateStudent()
            {
                var studName = document.studentform.stud_name.value;
                var studPhone = document.studentform.stud_phone.value;
                var studAddress = document.studentform.stud_address.value;
                // document.write(cName + "is" + cPhone);
                var studEmail = document.studentform.stud_email.value;
                
                var stud_list = <?php echo $js_studentResults ?>;
                var admin_list = <?php echo $js_adminResults ?>;
                var coor_list = <?php echo $js_coordinatorResults ?>;

                //Verified the user ID
				let id = "<?php if (isset($studId)) echo $studId?>";
                
                //Check against student data
                for(let counter = 0; counter < stud_list.length; counter++)
                {
					if(stud_list[counter].stud_matric_no == id)
					{
						continue;
					}
					else
					{
						//Check for similar email
						if(studEmail.toUpperCase() == stud_list[counter].stud_email.toUpperCase())
						{
							alert("Email address already exists!");
							document.studentform.stud_email.focus();
							return false;
						}
						//Check for similar phone number
						if(studPhone == stud_list[counter].stud_phone)
						{
							alert("Phone no. already exists!");
							document.studentform.stud_phone.focus();
							return false;
						}
					}
                }

                //Check against admin data
                for(let counter = 0; counter < admin_list.length; counter++)
                {
                    //Check for similar email
                    if(studEmail.toUpperCase() == admin_list[counter].admin_email.toUpperCase())
                    {
                        alert("Email address already exists!");
                        document.studentform.stud_email.focus();
                        return false;
                    }

                    //Check for similar phone number
                    if(studPhone == admin_list[counter].admin_phone)
                    {
                        alert("Phone no. already exists!");
                        document.studentform.stud_phone.focus();
                        return false;
                    }
                }

                //Check against coordinator data
                for(let counter = 0; counter < coor_list.length; counter++)
                {
                    //Check for similar email
                    if(studEmail.toUpperCase() == coor_list[counter].coor_email.toUpperCase())
                    {
                        alert("Email address already exists!");
                        document.studentform.stud_email.focus();
                        return false;
                    }

                    //Check for similar phone number
                    if(studPhone == coor_list[counter].coor_phone)
                    {
                        alert("Phone no. already exists!");
                        document.studentform.stud_phone.focus();
                        return false;
                    }
                }

                // check if the value is letter; return true if contains non-letter character
                if( /[^a-zA-Z ]/.test(studName))
                {
                    alert("Name cannot contain number!");
                    document.studentform.stud_name.focus();
                    return false;
                }

                // check if the value follow email format, that is: contains @ and .
                if( document.studentform.stud_email.value.indexOf("@") == -1 || document.studentform.stud_email.value.indexOf(".") == -1)
                {
                    alert("Invalid email format!! Symbol '@' or '.' not found!");
                    document.studentform.stud_email.focus();
                    return false;
                }

                // check if the value is number only
                if( isNaN(studPhone))
                {
                    alert("Please provide a proper phone number!");
                    document.studentform.stud_phone.focus();
                    return false;               
                }

                // check if the value contains at least 3 "," , as a proper address format have [housenumber + postalcode + state + countryname]
                if( (studAddress.match(/,/g)||[]).length < 3)
                {
                    alert("Please enter a valid address! The valid address should have at least 3 ','.");
                    document.studentform.stud_address.focus();
                    return false;
                }

                if (!confirm('Are you sure you want to update your profile?'))
                {
                    return false;
                }
            }
        </script>
	</head>
	<body>

    <div class = "form">

<?php

     if ($_SESSION['LEVEL'] == 1) { 

        ?>	 
        <form class = "input_form" method="post" action="update_admin.php?id=<?php echo $ID;?>" name="adminform" onsubmit="return validateAdmin()">
            <h1>Administrator's Information</h1>
            <div class="basic_information">
                <h2>Basic Information</h2>
                    <label for="name">Name: </label>
                    <input type="text" id="name" name="admin_name" value="<?php echo $rows['admin_name']?>" maxlength="50" required><br><br>

                    <label for="ic">Identification Card Number(IC): </label>
                    <input type="text" id="ic" name="admin_ic" value="<?php echo $rows['admin_ic']?>" maxlength="20" readonly><br><br>

                    <label for="staff">Staff No: </label>
                    <input type="text" id="staff" name="admin_staff_no" value="<?php echo $rows['admin_staff_no']?>" maxlength="10" readonly><br><br>

                    <label for="email">Email: </label>
                    <input type="text" id="email" name="admin_email" size="30" value="<?php echo $rows['admin_email']?>" maxlength="30" required><br><br>

                    <label for="hp">Phone Number (HP): </label>
                    <input type="text" id="hp" name="admin_phone" value="<?php echo $rows['admin_phone']?>" maxlength="20" required><br><br>

                    <label for="address">Address: </label>
                    <input type="text" id="address" name="admin_address" value="<?php echo $rows['admin_address']?>" maxlength="100" required><br><br>

            </div>
            <div class = "button_group">
                <input class = "right" type="submit" value="Submit">

                <a href="view_profile.php">
                    <input type="button" value="Cancel" onclick="return confirm('Are you sure you want to discard the changes?')">
                </a>
            </div>
        </form>
    <?php } else if ($_SESSION["LEVEL"] == 2) { ?>
        <form class = "input_form" method="post" action="update_coor.php?id=<?php echo $ID;?>" name="coorform" onsubmit="return validateCoordinator()">
            <h1>Coordinator's Information</h1>
            <div class="basic_information">
                <h2>Basic Information</h2>

                    <label for="name">Name: </label>
                    <input type="text" id="name" name="coor_name" value="<?php echo $rows['coor_name']?>" maxlength="50" required><br><br>

                    <label for="ic">Identification Card Number(IC): </label>
                    <input type="text" id="ic" name="coor_ic" value="<?php echo $rows['coor_ic']?>" maxlength="20" readonly><br><br>

                    <label for="staff">Staff No: </label>
                    <input type="text" id="staff" name="coor_staff_no" value="<?php echo $rows['coor_staff_no']?>" maxlength="10" readonly><br><br>

                    <label for="email">Email: </label>
                    <input type="text" id="email" name="coor_email" size="30" value="<?php echo $rows['coor_email']?>" maxlength="30" required><br><br>

                    <label for="hp">Phone Number (HP): </label>
                    <input type="text" id="hp" name="coor_phone" value="<?php echo $rows['coor_phone']?>" maxlength="20" required><br><br>

                    <label for="address">Address: </label>
                    <input type="text" id="address" name="coor_address" value="<?php echo $rows['coor_address']?>" maxlength="100" required><br><br>
            </div>

            <div class = "button_group">
                <input class = "right" type="submit" value="Submit">

                <a href="view_profile.php">
                    <input type="button" value="Cancel" onclick="return confirm('Are you sure you want to discard the changes?')">
                </a>
            </div>
        </form>
    <?php } else { ?>
        <form class = "input_form" method="post" action="update_student.php?id=<?php echo $ID;?>" name="studentform" onsubmit="return validateStudent()">
            <h1>Student's Information</h1>
            <div class="basic_information">
                <h2>Basic Information</h2>

                    <label for="name">Name: </label>
                    <input type="text" id="name" name="stud_name" value="<?php echo $rows['stud_name']?>" maxlength="50" required><br><br>

                    <label for="ic">Identification Card Number(IC): </label>
                    <input type="text" id="ic" name="stud_ic" value="<?php echo $rows['stud_ic']?>" maxlength="20" readonly><br><br>

                    <label for="matric">Matric No: </label>
                    <input type="text" id="matric" name="stud_matric_no" value="<?php echo $rows['stud_matric_no']?>" maxlength="10" readonly><br><br>

                    <label for="email">Email: </label>
                    <input type="text" id="email" name="stud_email" size="30" value="<?php echo $rows['stud_email']?>" maxlength="30" required><br><br>

                    <label for="hp">Phone Number (HP): </label>
                    <input type="text" id="hp" name="stud_phone" value="<?php echo $rows['stud_phone']?>" maxlength="20" required><br><br>

                    <label for="address">Address: </label>
                    <input type="text" id="address" name="stud_address" value="<?php echo $rows['stud_address']?>" maxlength="100" required><br><br>

            </div>
            <div class = "button_group">
                <input class = "right" type="submit" value="Submit">

                <a href="view_profile.php">
                    <input type="button" value="Cancel" onclick="return confirm('Are you sure you want to discard the changes?')">
                </a>
            </div>
        </form>
    <?php } ?>
    </div>
</body>
</html>

<?php
	     mysqli_close($conn);
?>