<?php
session_start();
include 'connection.php';
include 'logger/mensajeLog.php';

$callsign = $_POST["callsign"];
$origen = $_POST["origen"];
$destino = $_POST["destino"];
$npasajeros = $_POST["npasajeros"];
$fvuelo = $_POST["fvuelo"];


$sql = "INSERT INTO vuelo (callsign, fecha, numero_pasajeros, ciudad_salida, ciudad_llegada) VALUES (?,?,?,?,?)";

if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
	if ($consulta = $conn->prepare($sql))
	{
	    $consulta->bind_param("ssiss", $callsign, $fvuelo, $npasajeros, $origen, $destino);
	    $resultado = $consulta->execute();
	    
	    if($resultado) {
	    	$msg = "Añadido correctamente el vuelo: " . $callsign;
		echo '<script>mensajeLog("' . $msg . '"); 
			      alert("Vuelo añadido con exito"); 
			      window.location.replace("vuelos.php");
		     </script>';
	    	
		exit;
	    } else {
			$msg = "ERROR al añadir el vuelo: " . $callsign;
			echo '<script>mensajeLog("' . $msg . '"); 
			      window.location.replace("vuelos.php");
		     </script>';
	    	exit;
	    } 
	    $consulta->close();
	    $conn->close();
	}else
	{
	    // Gestion de errores de la consulta
		$msg = "Error en la consulta del vuelo: " . $callsign;
		echo '<script>mensajeLog("' . $msg . '"); </script>';
	    	include 'registro.php';
	    	$consulta->close();
	    	$conn->close();
	    	exit;
	}
}else{
$msg = "Error con el token CSRF";
echo '<script>mensajeLog("' . $msg . '"); </script>';
}
?>

