<?php
include 'connection.php';

//Obtenemos los datos del submit usando los id de cada apartado
$calls = $_POST["numcallsign"];
$sql = "DELETE FROM vuelo WHERE callsign = '$calls'";

if ($conn->query($sql) === TRUE){
	echo '<script> alert("Vuelo eliminado correctamente.");
		       window.location.replace("vuelos.php")</script>';
	exit;
	$conn->close();
} else {
	echo "Error: " . $conn->error;
		$conn->close(); 
}

?>
