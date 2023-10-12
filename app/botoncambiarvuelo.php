<?php
session_start();
include 'connection.php';

//Obtenemos los datos del submit usando los id de cada apartado
$calls = $_POST["calls"];
$fecha = $_POST["fecha"];
$numero_pasajeros = $_POST["pasajeros"];
$ciudad_salida = $_POST["origen"];
$ciudad_llegada = $_POST["destino"];
$dni = $_SESSION['dni'];

//Preparamos la instruccion SQL con los datos del formulario, en este caso un update
$sql = "UPDATE vuelo SET callsign = '$calls', fecha = '$fecha', numero_pasajeros = '$numero_pasajeros', ciudad_salida = '$ciudad_salida', ciudad_llegada = '$ciudad_llegada' WHERE callsign = '$calls' ";


//A traves del objeto de conexion $conn ejecutamos query() para enviar la instruccion de SQL
if ($conn->query($sql) === TRUE){
//Teniendo el usuario cambiado, cerramos la conexion a la base de datos
$conn->close();
echo '<script> alert("Vuelo modificado correctamente.");
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
