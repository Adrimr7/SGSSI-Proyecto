<?php
session_start();
include 'connection.php';

//Obtenemos los datos del submit usando los id de cada apartado
$callSign = $_POST["callsign"];

$sql = "DELETE FROM vuelo WHERE callsign = $callSign";

if ($conn->query($sql) === TRUE){
	include 'vuelos.php';
	exit;
}
else{
	echo "Error al eliminar el vuelo";
}

$conn->close();
?>
