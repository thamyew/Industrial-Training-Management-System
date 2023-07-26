<?php
session_start(); // Start up your PHP Session

// If the user is not logged in send him/her to the login form
if ($_SESSION["Login"] != "YES") 
header("Location: login.php");

require_once("config.php");

$sql = "SELECT * FROM student";
$sql_results = mysqli_query($conn, $sql);
$count = mysqli_num_rows($sql_results);
$results = array();

while ($row = mysqli_fetch_array($sql_results))
{
	array_push($results, $row);
}

$js_results = json_encode($results);

if ($count != 0)
{
	if ($_SESSION["LEVEL"] != 2 ) 
	{
		?>
		<html>
		<head>
			<title>Inserting Practical Training Data</title>
			<link rel="stylesheet" href="form_view.css">
			<script>
				function changeMatricNo()
				{
					var login = "<?php echo $_SESSION['LEVEL']?>";
					var inputField = document.getElementById('stud_matric_no_field');

					if (login == 3)
					{
						let stud_matric_no = "<?php if (isset($_SESSION['LOGIN_STUDENT'])) echo $_SESSION['LOGIN_STUDENT'];?>";
						let option = document.createElement("option");
						option.text = stud_matric_no;
						inputField.add(option);	
					}
					else if (login == 1)
					{
						var all_student = <?php echo $js_results?>;
						let counter;
						
						for (counter = 0; counter < all_student.length; counter++)
						{
							let stud_matric_no = all_student[counter].stud_matric_no;
							let option = document.createElement("option");
							option.text = stud_matric_no;
							inputField.add(option);
						}	
					}
				}

				function validateCompany()
				{
					var phone = document.practical_training_application_form.company_phone.value;
					var address = document.practical_training_application_form.company_address.value;

					// check if the value contains at least 3 "," , as a proper address format have [housenumber + postalcode + state + countryname]
					if( (address.match(/,/g)||[]).length < 3)
                	{
                 	   	alert("Please enter a valid address! The valid address should have at least 3 ','.");
                	    document.practical_training_application_form.company_address.focus();
                	    return false;
               	 	}

					// check if the value is number only
					if( isNaN(phone))
					{
						alert("Please provide a proper phone number!");
						document.practical_training_application_form.company_phone.focus();
						return false;
					}

					 // check if the value follow email format, that is: contains @ and . 
					if(document.practical_training_application_form.company_email.value.indexOf("@") == -1 ||
						document.practical_training_application_form.company_email.value.indexOf(".") == -1 )
						{
							alert("Invalid email format!! Symbol '@' or '.' not found!");
							document.practical_training_application_form.company_email.focus();
							return false;
						}

					if (!confirm("Are you sure you want to add this application?"))
					{
						return false;
					}
				}
			</script>
		</head>
		<body onload = "changeMatricNo()">
	
		<div class = "form">				
			<form class = "input_form" name="practical_training_application_form" method="POST" action = "insert_practical_training_application.php" onsubmit="return validateCompany()">
				<h1>Training Session Apply Form</h1>
				<p>Please fill in the following information:</p>
				<div class = "basic_information">
					<label for="company_name">Company Name: </label>
					<input type="text" id="company_name" name="company_name" maxlength="30" required>
					<br/><br/>
					<label for="company_address">Company Address: </label>
					<input type="text" id="company_address" name="company_address" maxlength="100" required>
					<br/><br/>
					<label for="company_phone">Company Phone: </label>
					<input type="text" id="company_phone" name="company_phone" maxlength="20" required>
					<br/><br/>
					<label for="company_email">Company Email: </label>
					<input type="text" id="company_email" name="company_email" maxlength="30" required>
					<br/><br/>
					<label for="training_startdate">Start Date: </label>
					<input type="date" id="training_startdate" name="training_startdate" required>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<label for="endDtraining_enddateate">End Date: </label>
					<input type="date" id="training_enddate" name="training_enddate" required>
					<br/><br/>
					
					<label for="stud_matric_no_field">Student Matric No.: </label>
					<select id = 'stud_matric_no_field' name='stud_matric_no'></select>
					
					<div class = 'button_group'>
						<button type="submit" name="button1">Apply</button>
						<a href="view_practical_training_application.php">
							<button type="button">Cancel</button>
						</a>
					</div>
					<br/>
				</div>
			</form>
		</div>
		</body>
		</html>
		<?php

		mysqli_close($conn);
	}	
}
else
{
	echo "<p>Wrong User Level! You are not authorized to view this page</p>";
 
	echo "<p><a href='main.php'>Go back to main page</a></p>";
	
	echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>