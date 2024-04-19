<?php

require("config.php");


$sql = "CREATE TABLE Organization(
        organization_ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        address VARCHAR(100),
        type VARCHAR(50) NOT NULL)";

if (mysqli_query($conn, $sql)) {
  echo "<h3>Table Organization created successfully</h3>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}


mysqli_close($conn);
?>