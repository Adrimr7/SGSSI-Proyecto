<?php
session_start();
include 'connection.php';

if (!empty($_POST['csrf_token'])) {
	if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
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
				echo '<script> window.location.replace("vuelos.php");</script>';
				exit;
				$conn->close();
			} 
			else {
				echo "Error: " . $conn->error;
				$conn->close(); 
				}
		}
	}else{
	echo $_SESSION['csrf_token'];
	
	echo "Error token CSRF no cuadra";
	echo $_POST['csrf_token'];
	}
}else{

echo "Error token CSRF vacio";
}
?>
