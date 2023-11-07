<?php
session_start();
include 'connection.php';

//Aqui navbar

$callsign = $_POST["callsign"];
$origen = $_POST["origen"];
$destino = $_POST["destino"];
$npasajeros = $_POST["npasajeros"];
$fvuelo = $_POST["fvuelo"];


//meter datos tabla


//$nombreCiudadOrigen = $_POST["origen"];
//$nombreCiudadDestino = $_POST["destino"];

$sql = "INSERT INTO vuelo (callsign, fecha, numero_pasajeros, ciudad_salida, ciudad_llegada) VALUES (?,?,?,?,?)";

if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
	if ($consulta = $conn->prepare($sql))
	{
	    $consulta->bind_param("ssiss", $callsign, $fvuelo, $npasajeros, $origen, $destino);
	    $resultado = $consulta->execute();
	    
	    if($resultado) {
		echo '<script> alert("Vuelo añadido con exito");</script>';
		echo '<script> window.location.replace("vuelos.php");</script>';
	    	$consulta->close();
		$conn->close();
		exit;
	    } else {
	    	echo '<script> alert("Se ha producido un error al añadir un vuelo.");</script>';
	    	$consulta->close();
		$conn->close();
	    	exit;
	    } 
	}else
	{
	    // Gestion de errores de la consulta
	    echo '<script> alert("Error en la consulta");</script>';
	    include 'registro.php';
	    $consulta->close();
	    $conn->close();
	    exit;
	}
}else{
echo "Error con el token CSRF";
}
?>
$consulta->close();
$conn->close();
