<?php
session_start(); // Start up your PHP Session

require('config.php'); // read up on php includes https://www.w3schools.com/php/php_includes.asp

if (isset($_COOKIE["username"]) && isset($_COOKIE["password"]) && isset($_COOKIE["level"])) {
    $myusername = $_COOKIE["username"];
    $mypassword = $_COOKIE["password"];

    // Escape special characters in the username and password
    $myusername = mysqli_real_escape_string($conn, $myusername);
    $mypassword = mysqli_real_escape_string($conn, $mypassword);

    $sql = "SELECT * FROM user WHERE username='$myusername' AND password='$mypassword'";

    $result = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $rows = mysqli_fetch_assoc($result);
        $user_name = $rows["username"];
        $user_id = $rows["password"];
        $user_level = $rows["level"];

        // Add user information to the session (global session variables)
        $_SESSION["Login"] = "YES";
        $_SESSION["USER"] = $user_name;
        $_SESSION["ID"] = $user_id;
        $_SESSION["LEVEL"] = $user_level;

        // Update the expiration time of the cookies
        setcookie("username", $user_name, time() + (86400 * 30), "/");
        setcookie("password", $user_id, time() + (86400 * 30), "/");
        setcookie("level", $user_level, time() + (86400 * 30), "/");

        header("Location: mainPage.php");
        exit();
    }
} else {
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form
        $myusername = $_POST["username"];
        $mypassword = $_POST["password"];

        // Escape special characters in the username and password
        $myusername = mysqli_real_escape_string($conn, $myusername);
        $mypassword = mysqli_real_escape_string($conn, $mypassword);

        $sql = "SELECT * FROM user WHERE username='$myusername' AND password='$mypassword'";

        $result = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $rows = mysqli_fetch_assoc($result);
            $user_name = $rows["username"];
            $user_id = $rows["password"];
            $user_level = $rows["level"];

            // Add user information to the session (global session variables)
            $_SESSION["Login"] = "YES";
            $_SESSION["USER"] = $user_name;
            $_SESSION["ID"] = $user_id;
            $_SESSION["LEVEL"] = $user_level;

            // Set the cookies
            setcookie("username", $user_name, time() + (86400 * 30), "/");
            setcookie("password", $user_id, time() + (86400 * 30), "/");
            setcookie("level", $user_level, time() + (86400 * 30), "/");

            header("Location: mainPage.php");
            exit();
        } else {
            $_SESSION["Login"] = "NO";
            header("Location: login.php?Message=" . urlencode("Wrong username or password"));
            exit();
        }
    } else {
        header("Location: login.php");
        exit();
    }
}

mysqli_close($conn);
?>
