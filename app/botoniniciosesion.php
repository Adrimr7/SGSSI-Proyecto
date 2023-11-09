<?php
session_start();
include 'connection.php';

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

		if (password_verify($contraseñaConSalt, $hashAlmacenado)) {
		    // Contraseña verificada con éxito
		    // Inicia la sesión y realiza las acciones necesarias
		    echo '<script> var message = "Contraseña correcta de DNI: ' . $dni . '";
				   var xhr = new XMLHttpRequest();
                                   xhr.open("POST", "../logger/logger.php", true);
                                   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                   xhr.send("message=" + message);</script>';
		    session_start();
		    $_SESSION['autenticado'] = true;
		    $_SESSION['dni'] = $dni;
		    include 'vuelos.php';
		    exit;
		} else {
		    echo '<script> var message = "Contraseña incorrecta de DNI: ' . $dni . '";
				   var xhr = new XMLHttpRequest();
                                   xhr.open("POST", "../logger/logger.php", true);
                                   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                   xhr.send("message=" + message);</script>';
		    
		    include 'iniciosesion.php';
		    exit;
		}
	    } else 
	    {
		echo '<script> var message = "Usuario con DNI: ' . $dni . ' no registrado.";
			       var xhr = new XMLHttpRequest();
                               xhr.open("POST", "../logger/logger.php", true);
                               xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                               xhr.send("message=" + message);</script>';
		include 'iniciosesion.php';
		exit;
	    }
	} 
	else
	{
	    echo '<script> var message = "Error en la consulta." ;
			   var xhr = new XMLHttpRequest();
                           xhr.open("POST", "../logger/logger.php", true);
                           xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                           xhr.send("message=" + message);</script>';
	    include 'iniciosesion.php';
	    exit;
	}
}else{
	echo '<script> var message = "Error en el token CSRF." ;
			   var xhr = new XMLHttpRequest();
                           xhr.open("POST", "../logger/logger.php", true);
                           xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                           xhr.send("message=" + message);</script>';
	    include 'iniciosesion.php';
	    exit;
}
function generateHash($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}
$consulta->close();
$conn->close();
?>

