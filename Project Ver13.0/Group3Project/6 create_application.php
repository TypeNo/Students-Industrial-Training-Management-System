<?php

require("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp


$sql = "CREATE TABLE Application (
  ApplicationID VARCHAR(30) PRIMARY KEY,
  matric VARCHAR(9),
  address VARCHAR(200),
  organization_ID INT UNSIGNED,
  training_ID INT,
  status VARCHAR(20),
  FOREIGN KEY (matric) REFERENCES Student(matric),
  FOREIGN KEY (organization_ID) REFERENCES Organization(organization_ID),
  FOREIGN KEY (training_ID) REFERENCES Training_Session(training_ID)
  )";

if (mysqli_query($conn, $sql)) {
  echo "<h3>Application table user created successfully</h3>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>