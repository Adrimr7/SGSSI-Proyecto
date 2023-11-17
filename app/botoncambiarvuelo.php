<?php
#header_remove('X-Powered-By');
session_start();
include 'connection.php';
include 'logger/mensajeLog.php';
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
	    	$msg = "Modificado correctamente el vuelo: " . $calls;
		echo '<script>mensajeLog("' . $msg . '"); 
	              window.location.replace("vuelos.php");</script>';
		exit;
	    } else {
	    	$msg = "ERROR al modificar el vuelo: " . $calls;
		echo '<script>mensajeLog("' . $msg . '");</script>';
	    	exit;
	    } 
	}else
	{
	    // Gestion de errores de la consulta
	    $msg = "ERROR en la consulta del vuelo: " . $calls;
	    echo '<script>mensajeLog("' . $msg . '"); 
	    window.location.replace("registro.php");</script>';
	    exit;
	}
}else{
	$msg = "ERROR con el token CSRF ";
	echo '<script>mensajeLog("' . $msg . '");</script>';
}
$consulta->close();
$conn->close();
?>
