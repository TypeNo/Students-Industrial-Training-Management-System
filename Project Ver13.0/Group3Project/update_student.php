<?php
session_start(); // Start up your PHP Session


if ($_SESSION["Login"] != "YES") {
    // If the user is not logged in or has been logged out, redirect to the login page
    header("Location: login.php");
    exit();
}

// Check the user's level
if ($_SESSION["LEVEL"] == 1) {
    // Only user level 1 can access this section


   
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $matric = $_POST["matric"];
    $IC = $_POST["IC"];
    $gender = $_POST["gender"];
    $contact_no = $_POST["contactNo"];
    $email = $_POST["email"];
    $year = $_POST["year"];
    $course = $_POST["course"];
    $gpa = $_POST["gpa"];
    $username = $_POST["username"];
    $password = $_POST["password"];
   


    // $matric = strtoupper($matric);
    $firstName = strtoupper($firstName);
    $lastName = strtoupper($lastName);
    $IC = strtoupper($IC);
    $email = strtolower($email);


    require("config.php");


    $sql1 = "UPDATE student SET
                firstName = '$firstName',
                lastName = '$lastName',
                IC = '$IC',
                gender = '$gender',
                contact_no = '$contact_no',
                email = '$email',
                year = '$year',
                course = '$course',
                gpa = '$gpa'
                WHERE matric = '$matric' ";

	$sql2 = "UPDATE user SET password = '$password'
			where username = '$username'";


    if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
        echo "<h3>Record updated successfully</h3>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


    mysqli_close($conn);


    header("Location: view_student.php");
    exit();

} else if ($_SESSION["LEVEL"] == 3) {
    // User level 3 can access this section

    $username = $_SESSION["USER"];
    $matric = $_POST["matric"];
    $contact_no = $_POST["contactNo"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    require("config.php");

    $sql1 = "UPDATE student SET
            contact_no = '$contact_no',
            email = '$email'
            WHERE username = '$username' ";

    $sql2 = "UPDATE user SET password = '$password'
            where username = '$username'";


    if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
        echo "<h3>Record updated successfully</h3>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


    mysqli_close($conn);


    header("Location: mainPage.php");
    exit();
} else {
    $level = $_SESSION["LEVEL"];
    echo $level;
    // If the user is not the correct level, display an error message
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
    exit();
}
?>