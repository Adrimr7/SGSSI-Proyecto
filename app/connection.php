<?php
//Preparamos los datos para la conexion con mysqli (una interfaz de MySQL para PHP)
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

//Abre la conexion al servidor de MySQL
$conn = mysqli_connect($hostname, $username, $password, $db);

//Si la concexion falla cerramos la concexion
if ($conn->connect_error) {
  die("La conexión ha fallado: " . $conn->connect_error);
}

?>
