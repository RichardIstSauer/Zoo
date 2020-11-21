<?php
include "connection.php";

$sql = "INSERT INTO futter (Futter)
VALUES ('Fleisch')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>