<?php
session_start();
include 'connection.php';

$calls = $_POST["callsign"];
$fecha = $_POST["fecha"];
$numero_pasajeros = $_POST["pasajeros"];
$ciudad_salida = $_POST["origen"];
$ciudad_llegada = $_POST["destino"];

//Preparamos la instruccion SQL con los datos del formulario, en este caso un update
$sql = "UPDATE vuelo SET fecha = '$fecha', numero_pasajeros = '$numero_pasajeros', ciudad_salida = '$ciudad_salida', ciudad_llegada = '$ciudad_llegada' WHERE callsign = '$calls' ";


//A traves del objeto de conexion $conn ejecutamos query() para enviar la instruccion de SQL
if ($conn->query($sql) === TRUE){
//Teniendo el usuario cambiado, cerramos la conexion a la base de datos
$conn->close();
echo '<script> 
	 window.location.replace("vuelos.php");
</script>';
exit;
}
else
{
echo "Error: " . $conn->error;
$conn->close();
}

?>
