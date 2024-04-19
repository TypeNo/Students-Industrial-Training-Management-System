<?php
session_start();

if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
    exit;
}

if ($_SESSION["LEVEL"] == 1) {
    $ID = $_GET["id"];

    require("config.php");

    $sql="SELECT u.username from user AS u 
          INNER JOIN coordinator AS c
          ON u.username =c.username 
          WHERE organization_ID='$ID';";
    $result=mysqli_query($conn,$sql);
    
    

    // Delete from the 'application' table
    $sql_application = "DELETE FROM application WHERE organization_ID = '$ID'";
    $result_application = mysqli_query($conn, $sql_application);

    // Delete from the 'training_session' table
    $sql_training_session = "DELETE FROM training_session WHERE organization_ID = '$ID'";
    $result_training_session = mysqli_query($conn, $sql_training_session);

    // Delete from the 'coordinator' table
    $sql_coordinate = "DELETE FROM coordinator WHERE organization_ID = '$ID'";
    $result_coordinate = mysqli_query($conn, $sql_coordinate);

    // Delete from the 'organization' table
    $sql_organization = "DELETE FROM organization WHERE organization_ID = '$ID'";
    $result_organization = mysqli_query($conn, $sql_organization);
    
    while($row=mysqli_fetch_assoc($result)){
        $username=$row['username'];
        $sql="DELETE FROM user WHERE username='$username';";
        mysqli_query($conn,$sql);
    }
    

    if ($result) {
        echo "<h3>Organization deleted successfully</h3>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

    header("Location: view_organization.php");
} else {
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>