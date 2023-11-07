<?php
session_start();
include 'connection.php';

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
if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {

	// Preparamos la instrucción SQL con los datos del formulario
	$sql = "INSERT INTO usuarios (dni, nombre, apellidos, telefono, email, contraseña, salt, nacimiento) VALUES (?,?,?,?,?,?,?,?)";

	if ($consulta = $conn->prepare($sql))
	{
	    //Asignamos el valor del dni al ? en la consulta
	    $consulta->bind_param("sssissss", $dni, $nombre, $apellidos, $telef, $email, $hash, $salt, $fnacimiento);
	    $resultado = $consulta->execute();
	    
	    if($resultado) {
	    	echo '<script> alert("Cuenta creada con exito.");</script>';
	    	include 'iniciosesion.php';
		exit;
	    } else {
	    	echo '<script> alert("Se ha producido un error al crear la cuenta.");</script>';
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
	echo "Error token CSRF";	
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

