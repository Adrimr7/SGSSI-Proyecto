<?php
#header_remove('X-Powered-By');
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

// Verifica reCAPTCHA
$recaptchaSecretKey = "6Le-Iw4pAAAAAKy2E0RvBBi4jpMBXjmkE6MxoPgY";
$response = $_POST['g-recaptcha-response'];
$verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecretKey}&response={$response}");
$data = json_decode($verify);

$num_usuarios = -1;

if ($data->success) {
	if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {

		$sql = "SELECT COUNT(*) as num_usuarios FROM usuarios WHERE dni = ?";
		if ($consulta = $conn->prepare($sql)) {
    			$consulta->bind_param("s", $dni);
    			$consulta->execute();
    			$consulta->bind_result($num_usuarios);
    			$consulta->fetch();
		} 
		else {
			$msg = "ERROR en la consulta comprobarDNIRegistro. ";
			echo '<script>mensajeLog("' . $msg . '");</script>';
		}
		$consulta->close();
		if ($num_usuarios == 0)
		{
			$salt = generarSalt();
			$contraseñaConSalt = $contraseña . $salt;
			$hash = generarHash($contraseñaConSalt);
			$sql2 = "INSERT INTO usuarios (dni, nombre, apellidos, telefono, email, contraseña, salt, nacimiento) VALUES (?,?,?,?,?,?,?,?)";
			if ($consulta2 = $conn->prepare($sql2))
			{
		    	//Asignamos el valor del dni al ? en la consulta
		    		$consulta2->bind_param("sssissss", $dni, $nombre, $apellidos, $telef, $email, $hash, $salt, $fnacimiento);
		    		$resultado = $consulta2->execute();
		    
		    		if($resultado)
		    		{
		    			$msg = "Cuenta creada correctamente para el usuario: " . $dni;
		        		echo '<script>mensajeLog("' . $msg . '");
		             		window.location.replace("iniciosesion.php");
		             		alert("Te has registrado correctamente!");
		    	     		</script>';
					exit;
		    		} 
		    		else
		    		{
		    			$msg = "ERROR al crear la cuenta de de: " . $dni;
		        		echo '<script>mensajeLog("' . $msg . '");
		    	      		alert("Se ha producido un error al crear la cuenta.");
		    	      		window.location.replace("registro.php");
		    	     		</script>';
		    		} 
			}
			else
			{
		    		// Gestion de errores de la consulta
		    		$msg = "ERROR con la consulta en el registro de: " . $dni;
		    		echo '<script>mensajeLog("' . $msg . '");
		    	  	window.location.replace("registro.php");
		    	  	alert("' . $dni . '");
		    	 	</script>';
		    		exit;
			}
			$consulta2->close();
   		} 
   		else {
   			$msg = "Ya existe un usuario con el DNI: " . $dni;
			echo '<script>mensajeLog("' . $msg . '");
		        window.location.replace("iniciosesion.php");
		        alert("Ya existe un usuario con ese DNI. Prueba a Iniciar Sesión.");</script>';
    		}
	}
	else
	{
		$msg = "ERROR con el token CSRF ";
		echo '<script>mensajeLog("' . $msg . '");</script>';	
	}
}
else
{
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

$conn->close();
?>

