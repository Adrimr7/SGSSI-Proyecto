<?php
session_start();
include 'connection.php';
include 'logger/mensajeLog.php';
//Aqui navbar

$nombre = $_POST["ciudad"];

$sql = "INSERT INTO ciudad (nombre) VALUES (?)";

if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
	if ($consulta = $conn->prepare($sql))
	{
	    $consulta->bind_param("s", $nombre);
	    $resultado = $consulta->execute();
	    
	    if($resultado) {
		$msg = "Añadida la ciudad: " . $nombre;
		echo '<script>mensajeLog("' . $msg . '"); 
	              window.location.replace("vuelos.php")</script>';
		exit;
	    } else {
		$msg = "ERROR al añadir la ciudad: " . $nombre;
		echo '<script>mensajeLog("' . $msg . '");;
		window.location.replace("vuelos.php")</script>';
	    	exit;
	    } 
	}
	else
	{
	    // Gestion de errores de la consulta
	    $msg = "ERROR en consulta al añadir la ciudad: " . $nombre;
	    echo '<script>mensajeLog("' . $msg . '"); </script>';
	    include 'registro.php';
	    
	    exit;
	}
	$consulta->close();
	$conn->close();
}else{
	$msg = "ERROR con el token CSRF.";
        echo '<script>mensajeLog("' . $msg . '"); </script>';
}
?>
$consulta->close();
$conn->close();
