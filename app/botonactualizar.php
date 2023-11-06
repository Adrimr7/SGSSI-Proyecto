<?php
session_start();
include 'connection.php';

//Obtenemos los datos del submit usando los id de cada apartado
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$telef = $_POST["telef"];
$fnacimiento = $_POST["fnacimiento"];
$email = $_POST["email"];
$contraseña = $_POST["contraseña"];
$dni = $_SESSION['dni'];

if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
	//Preparamos la instruccion SQL con los datos del formulario, en este caso un update
	$sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', telefono = '$telef', email = '$email', contraseña = '$contraseña', nacimiento = '$fnacimiento' WHERE dni = '$dni' ";


	//A traves del objeto de conexion $conn ejecutamos query() para enviar la instruccion de SQL
	if ($conn->query($sql) === TRUE){
			//Teniendo el usuario cambiado, cerramos la conexion a la base de datos
			$conn->close();
			include "vuelos.php";
			exit;
	} 
	else 
	{
		echo "Error: " . $conn->error;
			$conn->close(); 
	}
}else{
echo "Error con el token CSRF";
}
?>
