<?php
session_start(); // Start up your PHP Session


// echo $_SESSION["Login"]; //for session tracking purpose, can delete
// echo $_SESSION["LEVEL"]; //for session tracking purpose, can delete


// If the user is not logged in, send them to the login form
if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
}


if ($_SESSION["LEVEL"] == 1) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $matric = $_POST["matric"];
    $IC = $_POST["IC"];
    $gender = $_POST["gender"];
    $contactNo = $_POST["contactNo"];
    $email = $_POST["email"];
    $year = $_POST["year"];
    $course = $_POST["course"];
    $gpa = $_POST["gpa"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$level = $_POST["level"];

    // Perform any necessary validation on the input data here
    $firstName = strtoupper($firstName);
    $lastName = strtoupper($lastName);
    $matric = strtoupper($matric);
    $email = strtolower($email);
    $course = strtoupper($course);


    // Establish database connection
    require("config.php");
    try{
	// Insert new data into the user table
	$sqlUser = "INSERT INTO user (username, password, level) VALUES ('$username', '$password', '$level')";
	$resultUser = mysqli_query($conn, $sqlUser);

    // Prepare and execute the SQL query to insert the student data into the table
    $sql = "INSERT INTO student (matric, firstName, lastName, IC, gender, contact_no, email, year, course, gpa, username) VALUES ('$matric', '$firstName', '$lastName', '$IC', '$gender', '$contactNo', '$email', '$year', '$course', '$gpa', '$username')";


    if (mysqli_query($conn, $sql)) {
        echo "<h3>New record created successfully</h3>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


    // Close the database connection
    mysqli_close($conn);
    header("Location: view_student.php");
}catch(mysqli_sql_exception $e){
    $deleteUserSql = "DELETE FROM user WHERE username = '$username'";
    mysqli_query($conn, $deleteUserSql);
    ?>
<script>
alert("This MatricNo/Username had existed.Please retry the process with a new MatricNo/Username.")
window.location.href = "student_form.php?id=";
</script>
<?php }
    ?>


<?php
	
} else {
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>