<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: index.php");   //send user to login page

        
	$ID = $_GET['id'];
		 
	require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp
		 
	// Retrieve data from database
	$sql="SELECT * FROM student WHERE stud_matric_no='$ID'"; 
	$result = mysqli_query($conn, $sql);
	$rows=mysqli_fetch_assoc($result);

	//Validate the existence of data (retrieve data from database)
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

    if ($_SESSION["LEVEL"] == 1) {
?>
	<html>
	<head>
		<title>View Student Data</title>
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
					if (validateStudent())
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
						location.href = "view_student.php?id=" + id;
				}
				buttonDiv.append(cancelButton);
			}
			function validateStudent()
			{
				var studName = document.studform.stud_name.value;
				var studPhone = document.studform.stud_phone.value;
				var studIc = document.studform.stud_ic.value;
				var studAddress = document.studform.stud_address.value;
				var studEmail = document.studform.stud_email.value;
                
                var stud_list = <?php echo $js_studentResults ?>;
                var admin_list = <?php echo $js_adminResults ?>;
                var coor_list = <?php echo $js_coordinatorResults ?>;
                
                //Check against student data
                for(let counter = 0; counter < stud_list.length; counter++)
                {
                    //Verified the user ID
					let id = "<?php echo $ID?>";
					if(stud_list[counter].stud_matric_no == id)
					{
						continue;
					}
					else
					{
						//Check for similar IC
						if(studIc == stud_list[counter].stud_ic)
						{
							alert("IC no. already exists!");
							document.studform.stud_ic.focus();
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
                }

                //Check against admin data
                for(let counter = 0; counter < admin_list.length; counter++)
                {
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

				return true;
			}
        </script>
	<head>
	<body>    
    <div class = "form">
        <form class = "input_form" id = "form" method = "post" action="update_student.php?id=<?php echo $ID;?>" name="studform">
			<h1>Student's Data</h1>
			<div class="basic_information">
				<h2>Basic Information</h2>
				<label for="stud_name">Name: </label>
				<input type="text" id="stud_name" name="stud_name" value="<?php echo $rows['stud_name'] ?>" maxlength="50" readonly><br><br>

				<label for="stud_ic">Identification Card Number(IC): </label>
				<input type="text" id="stud_ic" name="stud_ic" value="<?php echo $rows['stud_ic'] ?>" maxlength="20" readonly><br><br>

				<label for="stud_matric_no">Matric No: </label>
				<input type="text" id="stud_matric_no" name="stud_matric_no" value="<?php echo $rows['stud_matric_no'] ?>" maxlength="10" readonly><br><br>

				<label for="stud_email">Email: </label>
				<input type="text" id="stud_email" name="stud_email" size="30" value="<?php echo $rows['stud_email'] ?>" maxlength="30" readonly><br><br>

				<label for="stud_phone">Phone Number (HP): </label>
				<input type="text" id="stud_phone" name="stud_phone" value="<?php echo $rows['stud_phone'] ?>" maxlength="20" readonly><br><br>

				<label for="stud_address">Address: </label>
				<input type="text" id="stud_address" name="stud_address" value="<?php echo $rows['stud_address'] ?>" maxlength="100" readonly><br>

				<div class="button_group" id ="button_group">
					<button id="dynamicButton" type="button" onclick="allowUpdateData()">Update</button>
				</div>
				<br/><br/>
			</div>

			<div class = "login_information">
				<h2>Login Information</h2>
				<label for="username">Username: </label>
				<input type="text" id="username" name="username" value="<?php echo $rows['stud_username'] ?>" readonly><br><br>
			</div>

			<div class = "button_group">
				<a href="view_student_list.php"> <input type="button" value="Back"></a>
				<a class = "right_1" href="delete_student.php?id=<?php echo $rows['stud_matric_no']?>"> <input type="button" value="Delete" onclick="return confirm('Are you sure you want to delete this student?');"></a>
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