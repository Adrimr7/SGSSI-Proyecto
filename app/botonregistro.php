<?php
session_start();
include 'connection.php';
include 'logger/mensajeLog.php';
// Obtenemos los datos del submit usando los id de cada apartado
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$dni = $_POST["dni"];
$telef = $_POST["telef"];
$fnacimiento = $_POST["fnacimiento"];
$email = $_POST["email"];
$contraseña = $_POST["contraseña"];

$salt = generarSalt();
$contraseñaConSalt = $contraseña . $salt;
$hash = generarHash($contraseñaConSalt);

// Verifica reCAPTCHA
$recaptchaSecretKey = "6Le-Iw4pAAAAAKy2E0RvBBi4jpMBXjmkE6MxoPgY";
$response = $_POST['g-recaptcha-response'];
$verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecretKey}&response={$response}");
$data = json_decode($verify);


if ($data->success) {
	if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {

		// Preparamos la instrucción SQL con los datos del formulario
		$sql = "INSERT INTO usuarios (dni, nombre, apellidos, telefono, email, contraseña, salt, nacimiento) VALUES (?,?,?,?,?,?,?,?)";

		if ($consulta = $conn->prepare($sql))
		{
		    //Asignamos el valor del dni al ? en la consulta
		    $consulta->bind_param("sssissss", $dni, $nombre, $apellidos, $telef, $email, $hash, $salt, $fnacimiento);
		    $resultado = $consulta->execute();
		    
		    if($resultado)
		    {
		    	$msg = "Cuenta creada correctamente para el usuario: " . $dni;
		        echo '<script>mensajeLog("' . $msg . '");
		             window.location.replace("iniciosesion.php");
		    	     </script>';
			exit;
		    } else {
		    	$msg = "ERROR al crear la cuenta de de: " . $dni;
		        echo '<script>mensajeLog("' . $msg . '");
		    	      alert("Se ha producido un error al crear la cuenta.");
		    	     </script>';
		    } 
		}
		else
		{
		    // Gestion de errores de la consulta
		    $msg = "ERROR con la consulta en el registro de: " . $dni;
		    echo '<script>mensajeLog("' . $msg . '");
		    	  window.location.replace("registro.php");
		    	 </script>';
		    exit;
		}
	}else{
		$msg = "ERROR con el token CSRF ";
		echo '<script>mensajeLog("' . $msg . '");</script>';	
	}
}else{
	$msg = "ERROR con el CAPTCHA ";
	echo '<script>mensajeLog("' . $msg . '");
	      alert("Error con el CAPTCHA");</script>';
}
function generarHash($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function generarSalt() {
    return bin2hex(random_bytes(16)); // Genera una salt de 16 bytes y la convierte en una cadena hexadecimal
}
$consulta->close();
$conn->close();
?>

