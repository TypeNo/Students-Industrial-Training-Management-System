<?php
session_start();

if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
    exit;
}

if ($_SESSION["LEVEL"] == 1) {
    $matric = $_GET["matric"];
    $username = $_GET["username"];

    require_once("config.php");

    //Ver5.0 addition
    $sql4 = "UPDATE training_session AS t
             INNER JOIN application AS a
             ON t.training_ID = a.training_ID
             SET current_amount = current_amount -1
             WHERE matric='$matric';";
    //
    $sql3= "DELETE FROM application WHERE matric ='$matric'";
    $sql1 = "DELETE FROM student WHERE matric = '$matric'";
    $sql2 = "DELETE FROM user WHERE username = '$username'";
    //Ver5.0 addition
    mysqli_query($conn, $sql4);
    //

    if (mysqli_query($conn, $sql3) && mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
        echo "<h3>Student and User deleted successfully</h3>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

	
    mysqli_close($conn);

    header("Location: view_student.php");
} else {
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>