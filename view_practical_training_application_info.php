<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: index.php");   //send user to login page

        
	$ID = $_GET['id'];
		 
	require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp
		 
	// Retrieve data from database
	$sql="SELECT * FROM practicalTrainingApplication WHERE application_id='$ID'"; 
	$result = mysqli_query($conn, $sql);
	$rows=mysqli_fetch_assoc($result);
?>
	<html>
	<head>
		<title>View Application Data</title>
		<link rel="stylesheet" href="form_view.css">
		<script>
			function allowUpdateData()
			{
				const inputFields = document.getElementsByTagName("input");
				let id = "<?php echo $ID?>";
				let num = inputFields.length;

				for(let i = 2; i < num - 3; i++)
				{
					inputFields[i].readOnly = false;
				}

				let dynamicButton = document.getElementById("dynamicButton");
				dynamicButton.innerText = "Confirm";
				dynamicButton.onclick = null;
				dynamicButton.onclick = function()
				{
					if (validateData())
						if (confirm("Are you sure you want to update this data?"))
							document.getElementById("form1").submit();
				}

				let cancelButton = document.createElement("button");
				let cancelText = document.createTextNode("Cancel");
				cancelButton.append(cancelText);
				cancelButton.type = "button";
				cancelButton.onclick = function()
				{
					if (confirm("Are you sure you want to discard the changes?"))
						location.href = "view_practical_training_application_info.php?id=" + id;
				}
				dynamicButton.parentNode.insertBefore(cancelButton, dynamicButton.nextSibling);
			}
			function validateData()
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

				return true;
			}
		</script>
	<head>
	<body>
	
	<div class = "form">
		<form class = "input_form" name = "practical_training_application_form" id="form1" method = "post" action="<?php if ($_SESSION["LEVEL"] != 2) echo 'update_practical_training_application.php'; else echo 'javascript:void(0);'?>">
			<h1>Application's Information</h1>
			<div class = "basic_information">
				<label for="application_id">Application No: </label>
				<input class = "number" type="text" id="application_id" name="application_id" value="<?php echo $rows['application_id']; ?>" readonly>
				<br/><br/>
				<label for="stud_matric_no">Student Matric No.: </label>
				<input type="text" id="stud_matric_no" name="stud_matric_no" value="<?php echo $rows['stud_matric_no']; ?>" readonly>
				<br/><br/>
				<label for="company_name">Company Name: </label>
				<input type="text" id="company_name" name="company_name" value="<?php echo $rows['company_name']; ?>" maxlength="30" readonly>
				<br/><br/>
				<label for="company_address">Company Address: </label>
				<input type="text" id="company_address" name="company_address" value="<?php echo $rows['company_address']; ?>" maxlength="100" readonly>
				<br/><br/>
				<label for="company_phone">Company Phone: </label>
				<input type="text" id="company_phone" name="company_phone" value="<?php echo $rows['company_phone']; ?>" maxlength="20" readonly>
				<br/><br/>
				<label for="company_email">Company Email: </label>
				<input type="text" id="company_email" name="company_email" value="<?php echo $rows['company_email']; ?>" maxlength="30" readonly>
				<br/><br/>
				<label for="training_startdate">Start Date: </label>
				<input type="date" id="training_startdate" name="training_startdate" value="<?php echo $rows['training_startdate']; ?>" readonly>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="endDtraining_enddateate">End Date: </label>
				<input type="date" id="training_enddate" name="training_enddate" value="<?php echo $rows['training_enddate']; ?>" readonly>
				<br/><br/>
				<label for="application_result">Application Result: </label>
				<input type="text" id="application_result" name="application_result" value="<?php echo $rows['application_result']; ?>" readonly>
				<div class = "button_group" id = "button_group">
					<?php if ($_SESSION["LEVEL"] == 1) { ?>
						<button class= "right" id="dynamicButton" type="button" onclick="allowUpdateData()">Update</button>
					<?php }
					else if ($_SESSION["LEVEL"] == 2) { ?>
						<a href="update_practical_training_application_status.php?id=<?php echo $rows['application_id']?>&status=Accepted&from=form" onclick="return confirm('Are you sure you want to accept this application?');"> <input type="button" value="Accept"></a>
						&nbsp;
						<a href="update_practical_training_application_status.php?id=<?php echo $rows['application_id']?>&status=Rejected&from=form" onclick="return confirm('Are you sure you want to reject this application?');"> <input type="button" value="Reject"></a>
					<?php } ?>
				</div>
				<br/>
			</div>

			<div class = "button_group">
				<a href="view_practical_training_application.php"> <input type="button" value="Back"></a>

				<?php if ($_SESSION["LEVEL"] == 1) { ?>
					<a class = "right_1" href="delete_practical_training_application.php?id=<?php echo $rows['application_id']?>"> <input type="button" value="Delete" onclick="return confirm('Are you sure you want to delete this application?');"></a>
				<?php } else if ($_SESSION["LEVEL"] == 3) { 
					if ($rows['application_result'] == "In Review") { ?>
					<a class = "right_1" href="delete_practical_training_application.php?id=<?php echo $rows['application_id']?>"> <input type="button" value="Delete" onclick="return confirm('Are you sure you want to delete this application?');"></a>
				<?php } } ?>
			</div>
		</form>
	</div>

</body>
</html>

<?php
  mysqli_close($conn);
?>
 
    	

