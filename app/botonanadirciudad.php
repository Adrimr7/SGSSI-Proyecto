<link rel= stylesheet href=styles.css>

<?php
include 'connection.php';

//Aqui navbar

$nombre = $_POST["ciudad"];


//meter datos tabla

$sql = "INSERT INTO ciudad (nombre) VALUES ('$nombre')";

if ($conn->query($sql) === TRUE){

	echo '<script> alert("Ciudad introducida correctamente.");</script>';
	echo '<script> window.location.replace("vuelos.php");</script>';



	exit;
	$conn->close();
		
} else {
	echo "Error: " . $conn->error;
	$conn->close(); 
}

?>
