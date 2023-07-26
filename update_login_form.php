<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: index.php");   //send user to login page

require("config.php");
$login_username = $_SESSION["USER"];
$sql = "SELECT * FROM login WHERE login_username = '$login_username'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($query);

?>
	<html>
	<head>
		<title>Change Password</title>
        <link rel="stylesheet" href="form_view.css">
        <script>
            function testing()
            {
                let currPassword = "<?php echo $result['login_password']?>";

                console.log(currPassword);
            }
            function validatePasswordChanged()
            {
                let currPassword = "<?php echo $result['login_password']?>";

                if (document.getElementById("curr_pass").value != currPassword)
                {
                    alert("The current password inputted is incorrect!");
                    document.getElementById("curr_pass").focus();
                    return false;
                }

                if (document.getElementById("new_pass").value != document.getElementById("re_new_pass").value)
                {
                    alert("The Re-enter password should be the same with the new password!");
                    document.getElementById("re_new_pass").focus();
                    return false;
                }

                // validate that the size must contain special character 
                var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
                if( !format.test(document.getElementById("new_pass").value))
                {
                    alert("Password must contain special character!");
                    document.getElementById("new_pass").focus();
                    return false;
                }

                return true;
            }
        </script>
	<head>
	<body onload = "testing()">

<?php
        
     $username = $_GET['username'];
    ?>	 
    <div class ="form">
        <form class = "input_form" method="post" onsubmit="return validatePasswordChanged()" action="update_login.php?id=<?php echo $username;?>">
            <h1>Change Password</h1>
            <div class = "login_information">
                <label for="curr_pass">Current Password: </label>
                <input type="password" id="curr_pass" name="curr_pass" maxlength="20" required><br><br>

                <label for="new_pass">New Password: </label>
                <input type="password" id="new_pass" name="new_pass" maxlength="20" required><br><br>

                <label for="re_new_pass">Re-enter the New Password: </label>
                <input type="password" id="re_new_pass" name="re_new_pass" maxlength="20" required><br><br>
            </div>

            <div class = "button_group">
                <input class = "right" type="submit" value="Submit">

                <a href="view_profile.php">
                    <input type="button" value="Cancel">
                </a>
            </div>
        </form>
    </div>
</body>
</html>