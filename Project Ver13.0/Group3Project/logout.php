<?php
session_start();

// if the user is logged in, unset the session
if (isset($_SESSION['USER'])) {
    unset($_SESSION['USER']);
}

session_destroy(); // destroy the session

// Delete the cookies
setcookie("username", "", time() - 3600, "/");
setcookie("password", "", time() - 3600, "/");
setcookie("level", "", time() - 3600, "/");

// go to login page
header('Location: login.php');
exit;
?> 
