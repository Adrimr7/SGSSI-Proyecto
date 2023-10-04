<?php
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";


$conn = new mysqli($hostname, $username, $password, $db);


if ($conn->connect_error) {
  die("La conexión ha fallado: " . $conn->connect_error);
}

?>
