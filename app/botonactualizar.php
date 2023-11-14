<?php
header_remove('X-Powered-By');
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
	    	$msg = "Actualizados los datos del usuario: " . $dni;
		echo '<script>mensajeLog("' . $msg . '");
		alert("Datos actualizados correctamente!");
		window.location.replace("vuelos.php");</script>';
	    } else {
	    	$msg = "ERROR al actualizar los datos del usuario: " . $dni;
		echo '<script> mensajeLog("' . $msg . '");
		alert("Datos actualizados correctamente!");
		</script>';
	    } 
	}else
	{
	    // Gestion de errores de la consulta
	    $msg = "ERROR en la consulta del usuario: " . $dni;
	    echo '<script>mensajeLog("' . $msg . '");
	    window.location.replace("registro.php");</script>';
	    exit;
	}
}else{
	$msg = "ERROR con el token CSRF";
	echo '<script>mensajeLog("' . $msg . '"); </script>';
}
?>
$consulta->close();
$conn->close();
