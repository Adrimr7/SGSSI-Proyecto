<?php
session_start();
include 'connection.php';
if (isset($_POST['accion']) && $_POST['accion'] === 'modificar') 
{
   if (isset($_POST['numcallsign'])) 
   {
     $_SESSION['callsign'] = $_POST["numcallsign"];
   }
   include 'modificarvuelo.html';
}

if (isset($_POST['accion']) && $_POST['accion'] === 'eliminar') 
   {
   	$calls = $_POST['numcallsign'];
   	echo $calls;
	$sql = "DELETE FROM vuelo WHERE callsign = '$calls'";

	if ($conn->query($sql) === TRUE){
		echo '<script> alert("Vuelo eliminado correctamente.");
		       window.location.replace("vuelos.php");</script>';
		exit;
		$conn->close();
	} 
	else {
		echo "Error: " . $conn->error;
		$conn->close(); 
		}
    } 
?>
