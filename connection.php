<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "sauer";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Verbindungsfehler" . $conn->connect_error);
}



