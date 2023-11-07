<?php
session_start();
include 'connection.php';

//Aqui navbar

$nombre = $_POST["ciudad"];
echo $_SESSION['csrf_token'];

$sql = "INSERT INTO ciudad (nombre) VALUES (?)";

if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
	if ($consulta = $conn->prepare($sql))
	{
	    $consulta->bind_param("s", $nombre);
	    $resultado = $consulta->execute();
	    
	    if($resultado) {
		echo '<script> alert("Ciudad introducida correctamente.");</script>';
		echo '<script> window.location.replace("vuelos.php");</script>';
	    	$consulta->close();
		$conn->close();
		exit;
	    } else {
	    	echo '<script> alert("Se ha producido un error al añadir una nueva ciudad.");</script>';
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
	echo $_SESSION['csrf_token'];
	echo "Error con el token CSRF";
	echo $_POST['csrf_token'];
}
?>
$consulta->close();
$conn->close();
