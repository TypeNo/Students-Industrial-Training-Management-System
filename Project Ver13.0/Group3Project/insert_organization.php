<?php
session_start();

if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
}

if ($_SESSION["LEVEL"] == 1) {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $type = $_POST["type"];
    
    $address = ucwords(strtolower($address));
    $name = strtoupper($name);
    $type = strtoupper($type);

    // Establish database connection
    require("config.php");
    
    $sql = "INSERT INTO Organization(name, address, type)
            VALUES ('$name', '$address', '$type')";

    if (mysqli_query($conn, $sql)) {
        echo "<h3>New organization created successfully</h3>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);

    header("Location: view_organization.php");
?>

<?php
} else {
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>