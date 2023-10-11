<?php
session_start();
include 'connection.php';

//Obtenemos los datos del submit usando los id de cada apartado
$callSign = $_POST["callsign"];


//Este es un intento algo (bastante) mal planteado


/*


//Preparamos la instruccion SQL con los datos del formulario, en este caso una insercion de nuevo usuario
$sql = "INSERT INTO usuarios (dni, nombre, apellidos, telefono, email, contraseña, nacimiento) VALUES ('$dni','$nombre','$apellidos','$telef','$email','$contraseña','$fnacimiento')";

//A traves del objeto de conexion $conn ejecutamos query() para enviar la instruccion de SQL
if ($conn->query($sql) === TRUE){
		//Teniendo el usuario registrado, cerramos la conexion a la base de datos
		$conn->close();
		//Y pasamos a la pagina vuelos.php
		include 'vuelos.php';

		
		exit;
} else {
	echo "Error: " . $conn->error;
		$conn->close(); 
}
*/
?>
