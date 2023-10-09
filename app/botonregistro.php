<?php
session_start();
include 'connection.php';

$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$dni = $_POST["dni"];
$telef = $_POST["telef"];
$fnacimiento = $_POST["fnacimiento"];
$email = $_POST["email"];
$contraseña = $_POST["contraseña"];

//meter datos tabla

$sql = "INSERT INTO usuarios (dni, nombre, apellidos, telefono, email, contraseña, nacimiento) VALUES ('$dni','$nombre','$apellidos','$telef','$email','$contraseña','$fnacimiento')";

if ($conn->query($sql) === TRUE){
		$conn->close();
		include 'vuelos.php';
	        echo "<h1>Usuario $nombre con DNI: $dni con fecha de nacimiento de $fnacimiento registrado correctamente</h1>";
		exit;
} else {
	echo "Error: " . $conn->error;
		$conn->close(); 
}

?>
