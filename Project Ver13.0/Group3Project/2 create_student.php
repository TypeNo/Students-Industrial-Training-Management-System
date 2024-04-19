<?php

require("config.php");


$sql = "CREATE TABLE student(
        matric VARCHAR(9) PRIMARY KEY,
        firstName VARCHAR(75) NOT NULL,
        lastName VARCHAR(75) NOT NULL,
        IC VARCHAR(12);
        gender VARCHAR(10),
        contact_no VARCHAR(50),
        email VARCHAR(50),
        year INT,
        course VARCHAR(50),
        gpa DECIMAL(4, 2),
        username varchar(100),
        FOREIGN KEY (username) REFERENCES user(username)
        )";


if (mysqli_query($conn, $sql)) {
  echo "<h3>Table student created successfully</h3>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}


mysqli_close($conn);
?>