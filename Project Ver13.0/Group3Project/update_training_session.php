<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") {
    header("Location: index.php");
}

if ($_SESSION["LEVEL"] == 1 || $_SESSION["LEVEL"] == 2) { // Only user level 1 can access

    $trainingID = $_POST['trainingID'];
    $name = $_POST['name'];
    $description = htmlentities($_POST['description']);
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $requiredAmount = $_POST['requiredAmount'];
    $allowance = $_POST['allowance'];

    require("config.php");

    // Update training session data in the Training_Session table
    $sql = "UPDATE Training_Session SET name = '$name', description = '$description', startDate = '$startDate', endDate = '$endDate', required_amount = '$requiredAmount', allowance = '$allowance' WHERE training_ID = '$trainingID'";

    if (mysqli_query($conn, $sql)) {
        header("Location: view_training_session.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
} else if ($_SESSION["LEVEL"] != 1) { // If the user is not the correct level
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='view_training_session.php'>Go back to the view training session page</a></p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>