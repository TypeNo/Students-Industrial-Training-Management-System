<?php

require("config.php");


$sql = "CREATE TABLE Training_Session(
        training_ID INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        description VARCHAR(200),
        startDate DATE,
        endDate DATE,
        required_amount INT,
        CHECK (required_amount>=0),
        current_amount INT DEFAULT 0,
        CHECK (current_amount<=required_amount),
        allowance INT,
        organization_ID INT UNSIGNED,
        FOREIGN KEY (organization_ID) REFERENCES Organization(organization_ID)
        )";




if (mysqli_query($conn, $sql)) {
  echo "<h3>Table Training Session created successfully</h3>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}




mysqli_close($conn);
?>