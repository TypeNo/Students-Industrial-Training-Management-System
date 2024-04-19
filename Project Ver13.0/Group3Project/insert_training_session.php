<?php
session_start();

if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
}

if ($_SESSION["LEVEL"] == 1 || $_SESSION["LEVEL"] == 2) {
    $name = $_POST["name"];
    $description = htmlentities($_POST['description']);
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $requiredAmount = $_POST["requiredAmount"];
    $allowance = $_POST["allowance"];
    $organizationID = $_POST["selected_organization_ID"];

    $name = strtoupper($name);

    // Establish database connection
    require("config.php");
    
    // Insert the training session data into the database
    $sql = "INSERT INTO Training_Session(name, description, startDate, endDate, required_amount, allowance, organization_ID)
            VALUES ('$name', '$description', '$startDate', '$endDate', $requiredAmount, $allowance, '$organizationID')";

    if (mysqli_query($conn, $sql)) {
        header("Location: view_training_session.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
?>

<?php
} else {
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>