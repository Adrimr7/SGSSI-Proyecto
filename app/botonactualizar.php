<?php
session_start();
include 'connection.php';
include 'logger/mensajeLog.php';
//Obtenemos los datos del submit usando los id de cada apartado
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$telef = $_POST["telef"];
$fnacimiento = $_POST["fnacimiento"];
$email = $_POST["email"];
$contrasena = $_POST["contraseña"];
$dni = $_SESSION['dni'];

$sql = "UPDATE usuarios SET nombre = ?, apellidos = ?, telefono = ?, email = ?, contraseña = ?, nacimiento = ? WHERE dni = ? ";

if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
	if ($consulta = $conn->prepare($sql))
	{
	    $consulta->bind_param("ssissss", $nombre, $apellidos, $telef, $email, $contrasena, $fnacimiento, $dni);
	    $resultado = $consulta->execute();
	    
	    if($resultado) {
	    	echo '<script> alert("Datos actualizados con exito");</script>';
		include "vuelos.php"; //o seria window location replace?
		exit;
	    } else {
	    	echo '<script> alert("Se ha producido un error al actualizar tus datos.");</script>';
	    	exit;
	    } 
	}else
	{
	    // Gestion de errores de la consulta
	    echo '<script> alert("Error en la consulta");</script>';
	    include 'registro.php';
	    exit;
	}
}else{
	echo "Error con el token CSRF";
}
?>
$consulta->close();
$conn->close();
