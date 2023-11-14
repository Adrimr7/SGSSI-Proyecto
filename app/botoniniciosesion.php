<?php
header_remove('X-Powered-By');
session_start();
include 'connection.php';
include 'logger/mensajeLog.php';
        
$dni = $_POST["dni"];
$contraseña = $_POST["contrasena"];

// Preparar la consulta para recuperar el hash y la salt
$sql = "SELECT contraseña, salt FROM usuarios WHERE dni = ?";
if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
	if ($consulta = $conn->prepare($sql))
	{
	    //Asignamos el valor del dni al ? en la consulta
	    $consulta->bind_param("s", $dni);
	    $consulta->execute();
	    $resultado = $consulta->get_result();

	    //Si obtenemos algun resultado
	    if ($resultado->num_rows > 0) {
		$fila = $resultado->fetch_assoc();
		$hashAlmacenado = $fila['contraseña'];
		$saltAlmacenado = $fila['salt'];

		// Concatenar la contraseña proporcionada con la salt almacenada
		$contraseñaConSalt = $contraseña . $saltAlmacenado;

		if (password_verify($contraseñaConSalt, $hashAlmacenado)) 
		{
		    // Contraseña verificada con éxito

		    $msg = "Contraseña correcta de DNI: $dni";
    		    echo '<script>mensajeLog("' . $msg . '");</script>';
    		    
		    session_start();
		    $_SESSION['autenticado'] = true;
		    $_SESSION['dni'] = $dni;
		    include 'vuelos.php';
		    exit;
		} 
		else
		{
		    $msg = "Contraseña incorrecta de DNI: $dni";
		    echo '<script>mensajeLog("' . $msg . '");</script>';
		    include 'iniciosesion.php';
		    exit;

		}
	    } 
	    else 
	    {
		$msg = "Usuario no registrado con DNI: $dni";
    		echo '<script>mensajeLog("' . $msg . '");</script>';
		include 'iniciosesion.php';
		exit;
	    }
	} 
	else
	{
	    $msg = "Error en la consulta.";
            echo '<script>mensajeLog("' . $msg . '");</script>';
	    include 'iniciosesion.php';
	    exit;
	}
}
else
{
	$msg = "Error en el Token CSRF";
    	echo '<script>mensajeLog("' . $msg . '");</script>';
	include 'iniciosesion.php';
	exit;
}
function generateHash($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}
$consulta->close();
$conn->close();
?>

