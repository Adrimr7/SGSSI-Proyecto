
<link rel= stylesheet href=styles.css>

<?php
include 'connection.php';

//Aqui navbar

$callsign = $_POST["callsign"];
$origen = $_POST["origen"];
$destino = $_POST["destino"];
$npasajeros = $_POST["npasajeros"];
$fvuelo = $_POST["fvuelo"];


//meter datos tabla


$nombreCiudadOrigen = $_POST["origen"];
$nombreCiudadDestino = $_POST["destino"];


//meter datos tabla

$sql = "SELECT nombre FROM ciudad WHERE nombre = '$nombreCiudadOrigen'";

$result = $conn->query($sql);


if ($result->fetch_assoc()['nombre'] == $_POST["origen"])
{
    echo '<script>console.log("Origen en base de datos")</script>';
} 
else 
{
	$sql = "INSERT INTO ciudad (nombre) VALUES ('$nombreCiudadOrigen')";

    if ($conn->query($sql) === TRUE){
	    //echo "Ciudad introducida correctamente.";
		echo '<script>console.log("Ciudad añadida")</script>';
		    //$conn->close();
		    exit;
    } 
    else 
    {
	    echo "Error: " . $conn->error;
		    $conn->close(); 
    }   
}

//Comprobamos si la ciudad de destino se encuentra en la base de datos
$sql = "SELECT nombre FROM ciudad WHERE nombre = '$nombreCiudadDestino'";

$result = $conn->query($sql);

if ($result->fetch_assoc()['nombre'] == $_POST["destino"])
{
    echo '<script>console.log("Destino en base de datos")</script>';
} 
else 
{
	$sql = "INSERT INTO ciudad (nombre) VALUES ('$nombreCiudadDestino')";

    if ($conn->query($sql) === TRUE){
	    //echo "Ciudad introducida correctamente.";
		echo '<script>console.log("Ciudad añadida")</script>';
	
		    //$conn->close();
		    exit;
    } 
    else 
    {
	    echo "Error: " . $conn->error;
		    $conn->close(); 
    }   
}


//Comprobamos si la ciudad de origen se encuentra en la base de datos

//Por ultimo introducimos el vuelo en la base de datos

$sql = "INSERT INTO vuelo (callsign, fecha, numero_pasajeros, ciudad_salida, ciudad_llegada) VALUES ('$callsign','$fvuelo','$npasajeros','$origen','$destino')";

if ($conn->query($sql) === TRUE){
	echo '<script> window.location.replace("vuelos.php")</script>';
	exit;
	$conn->close();
} else {
	echo "Error: " . $conn->error;
		$conn->close(); 
}

?>
