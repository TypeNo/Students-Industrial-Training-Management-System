<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") // If the user is not logged in or has been logged out
    header("Location: index.php"); // Redirect user to the login page

if ($_SESSION["LEVEL"] == 1) { // Only user level 1 can access

    $ID = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $organization_ID = $_POST['selected_organization_ID'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $firstName = strtoupper($firstName);
    $lastName = strtoupper($lastName);
    $email = strtolower($email);

    require("config.php");

    // Update coordinator data in the Coordinator table
    $sql1 = "UPDATE Coordinator SET firstName = '$firstName', lastName = '$lastName', email = '$email', organization_ID = '$organization_ID' WHERE coordinate_ID = '$ID'";
    $sql2 = "UPDATE user SET password = '$password' where username = '$username'";

    if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
        header("Location: view_coordinator.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


    mysqli_close($conn);

    } else if ($_SESSION["LEVEL"] == 2) { 

    $ID = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $organization_ID = $_POST['selected_organization_ID'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $firstName = strtoupper($firstName);
    $lastName = strtoupper($lastName);
    $email = strtolower($email);

    require("config.php");

    // Update coordinator data in the Coordinator table
    $sql1 = "UPDATE Coordinator SET firstName = '$firstName', lastName = '$lastName', email = '$email', organization_ID = '$organization_ID' WHERE coordinate_ID = '$ID'";
    $sql2 = "UPDATE user SET password = '$password' where username = '$username'";

    if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
        header("Location: mainPage.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


    mysqli_close($conn);

} else if ($_SESSION["LEVEL"] != 1) { // If the user is not the correct level
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>