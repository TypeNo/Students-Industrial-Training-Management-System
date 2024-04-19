<?php

require("config.php");


$sql = "CREATE TABLE Coordinator(
        coordinate_ID INT AUTO_INCREMENT PRIMARY KEY,
        firstName VARCHAR(75) NOT NULL,
        lastName VARCHAR(75) NOT NULL,
        email VARCHAR(100),
        organization_ID INT UNSIGNED,
        username VARCHAR(100),
        FOREIGN KEY (username) REFERENCES user(username),
        FOREIGN KEY (organization_ID) REFERENCES   Organization(organization_ID)
        )";


if (mysqli_query($conn, $sql)) {
  echo "<h3>Table student created successfully</h3>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}




mysqli_close($conn);
?>