<?php
session_start();
include 'connection.php';
include 
'logger/mensajeLog.php';
$calls = $_POST["callsign"];
$fecha = $_POST["fecha"];
$numero_pasajeros = $_POST["pasajeros"];
$ciudad_salida = $_POST["origen"];
$ciudad_llegada = $_POST["destino"];
$sql = "UPDATE vuelo SET fecha = ?, numero_pasajeros = ?, ciudad_salida = ?, ciudad_llegada = ? WHERE callsign = ? ";

if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
	if ($consulta = $conn->prepare($sql))
	{
	    $consulta->bind_param("sisss", $fecha, $numero_pasajeros, $ciudad_salida, $ciudad_llegada, $calls);
	    $resultado = $consulta->execute();
	    
	    if($resultado) {
	    	echo '<script> alert("Vuelo modificado con exito.");</script>';
	    	echo '<script> window.location.replace("vuelos.php"); </script>';
	    	$consulta->close();
		$conn->close();
		exit;
	    } else {
	    	echo '<script> alert("Se ha producido un error al modificar el vuelto.");</script>';
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
