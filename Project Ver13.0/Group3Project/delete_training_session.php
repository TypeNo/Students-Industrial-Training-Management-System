<?php
session_start();

if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
    exit;
}

if ($_SESSION["LEVEL"] != 3) {
    $training_id=$_GET['id'];

    require_once("config.php");
    
    $sql1= "DELETE FROM application WHERE training_ID ='$training_id'";
    $sql2 = "DELETE FROM training_session WHERE training_ID = '$training_id'";


    if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
        echo "<h3>Student deleted successfully</h3>";
    } else {
        echo "Error: " . $sql2."<br>". $sql1 . "<br>" . mysqli_error($conn);
    }

	
    mysqli_close($conn);

    header("Location: view_training_session.php");
} else {
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>