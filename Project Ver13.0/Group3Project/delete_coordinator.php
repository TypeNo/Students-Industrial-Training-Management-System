<?php
session_start();

if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
    exit;
}

if ($_SESSION["LEVEL"] == 1) {
    $ID = $_GET["id"];
    $username = $_GET["username"];

    require("config.php");

    $sql = "DELETE FROM Coordinator WHERE coordinate_ID = '$ID'";
    $sql2 = "DELETE FROM User WHERE username = '$username'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<h3>Coordinator deleted successfully</h3>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $result2 = mysqli_query($conn, $sql2);

    if ($result) {
        echo "<h3>User deleted successfully</h3>";
    } else {
        echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

    header("Location: view_coordinator.php");
} else {
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>