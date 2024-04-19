<?php

require("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp


$sql = "CREATE TABLE user
        (
          username varchar(100) PRIMARY KEY,
          password varchar(50),
          level int(3)
        )";

if (mysqli_query($conn, $sql)) {
  echo "<h3>Project table user created successfully</h3>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>