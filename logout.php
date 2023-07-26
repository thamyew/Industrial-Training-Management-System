<?php
session_start(); 

// Unset all of the session variables.
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

setcookie("remembered_login", "", time() - 42000);
setcookie("remembered_login_type", "", time() - 42000);

session_destroy(); //destroy the session

// go to login page 
header('Location: index.php'); 
exit; 
?> 