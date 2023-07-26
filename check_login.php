<?php 
ini_set("session.cookie_lifetime", '3600');

session_start(); // Start up PHP Session
 
require('config.php');//read up on php includes https://www.w3schools.com/php/php_includes.asp

$sql;

if (isset($_COOKIE["remembered_login"]))
{
    $myusername=$_COOKIE["remembered_login"];

    $sql="SELECT * FROM login WHERE login_username='$myusername'";  
}
else
{
    // username and password sent from form
    $myusername=$_POST["username"];
    $mypassword=$_POST["password"];

    $sql="SELECT * FROM login WHERE login_username='$myusername' and login_password='$mypassword'";
}

$result = mysqli_query($conn, $sql);

$rows=mysqli_fetch_assoc($result);

$user_name=$rows["login_username"];
$user_password=$rows["login_password"];
$user_type=$rows["login_usertype"];

// mysqli_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

    // Add user information to the session (global session variables)		
    $_SESSION["Login"] = "YES";
    $_SESSION["USER"] = $user_name;
    $_SESSION["PASS"] = $user_password;
    $_SESSION["USERTYPE"] = $user_type;

    setcookie("remembered_login", $user_name, time() + 3600);
    setcookie("remembered_login_type", $user_type, time() + 3600);

if ($_SESSION["USERTYPE"] == "Student")
{
    $_SESSION["LEVEL"] = 3;

    $sql = "SELECT * FROM student WHERE stud_username='$user_name'";
    $sql_result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_result);
    $stud = $result['stud_matric_no'];

    $_SESSION["LOGIN_STUDENT"] = $stud;
}
else if ($_SESSION["USERTYPE"] == "Coordinator")
{
    $_SESSION["LEVEL"] = 2;

    $sql = "SELECT * FROM coordinator WHERE coor_username='$user_name'";
    $sql_result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_result);
    $coor_staff = $result['coor_staff_no'];

    $_SESSION["LOGIN_COORDINATOR"] = $coor_staff;
}    
else if ($_SESSION["USERTYPE"] == "Admin")
{
    $_SESSION["LEVEL"] = 1;

    $sql = "SELECT * FROM admin WHERE admin_username='$user_name'";
    $sql_result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($sql_result);
    $admin_staff = $result['admin_staff_no'];

    $_SESSION["LOGIN_ADMIN"] = $admin_staff;
}

header("Location: main.php");

//if wrong username and password
} else {
	
$_SESSION["Login"] = "NO";
header("Location: index.php?login=false");
}

mysqli_close($conn);

?>
