<?php
session_start();

if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
}

if ($_SESSION["LEVEL"] == 1) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $organizationID = $_POST["selected_organization_ID"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $firstName = strtoupper($firstName);
    $lastName = strtoupper($lastName);
    $email = strtolower($email);

    // Establish database connection
    require_once("config.php");


    $sql = "INSERT INTO coordinator(firstName, lastName, email, organization_ID, username)
        VALUES ('$firstName', '$lastName', '$email', '$organizationID', '$username')";
    $sql2 = "INSERT INTO user(username, password, level)
            VALUES ('$username', '$password', 2)";
    try {
        if (mysqli_query($conn, $sql2)) {
            echo "<h3>New User created successfully</h3>";
        } else {
            echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
        }

        if (mysqli_query($conn, $sql)) {
            echo "<h3>New Coordinator created successfully</h3>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }



        // Close the database connection
        mysqli_close($conn);

        header("Location: view_coordinator.php");
    } catch (mysqli_sql_exception $e) { ?>
<script>
alert("This username had existed.Please retry the process with a new username")
window.location.href = "coordinator_form.php?id=";
</script>
<?php }

    ?>

<?php
} else {
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>