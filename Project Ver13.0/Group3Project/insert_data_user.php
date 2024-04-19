<?php

require("config.php");

$sql = "INSERT INTO user (username, password, level)
VALUES ('admin', '0000', 1);";
$sql .= "INSERT INTO user (username, password, level)
VALUES ('coordinator1', '1111', 2);";
$sql .= "INSERT INTO user (username, password, level)
VALUES ('student1', '9999', 3)";

if (mysqli_multi_query($conn, $sql)) {
  echo "<h3>Project new records created successfully</h3>";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>