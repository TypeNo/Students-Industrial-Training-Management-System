<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") {
    header("Location: index.php");
}

if ($_SESSION["LEVEL"] == 1) { // Only user level 1 can access

    $ID = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $type = $_POST['type'];

    $address = ucwords(strtolower($address));
    $name = strtoupper($name);
    $type = strtoupper($type);
    
    // Establish database connection
    require("config.php");
    
    // Update organization data in the Organization table
    $sql = "UPDATE Organization SET name = '$name', address = '$address', type = '$type' WHERE organization_ID = '$ID'";

    if (mysqli_query($conn, $sql)) {
        header("Location: view_organization.php");
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