<?php
include 'connection.php';
include 'logger/mensajeLog.php';
//Obtenemos los datos del submit usando los id de cada apartado
$calls = $_POST["numcallsign"];
$sql = "DELETE FROM vuelo WHERE callsign = '$calls'";

if ($conn->query($sql) === TRUE)
{
	$msg = "Vuelo con callsign: $calls eliminado.";
	echo '<script> mensajeLog("' . $msg . '");
	    	       alert("Vuelo eliminado correctamente.");
		       window.location.replace("vuelos.php")</script>';
		       
	exit;
	$conn->close();
} 
else 
{
	echo "Error: " . $conn->error;
	$conn->close(); 
}

?>
