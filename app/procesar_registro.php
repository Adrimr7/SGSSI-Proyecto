
<link rel= stylesheet href=styles.css>

<?php
include 'connection.php';


// ESTA PARTE ERA PARA MOSTRAR LOS NOMBRES DE LAS TABLAS DE LA BASE DE DATOS, PERO NO FUNCIONA

/*
$query = "SHOW TABLES";
$result = $conn->query($query);

while ($row = $result->fetch_row()) {
    echo $row[0] . "<br>";
}

$conn->close();

*/

//ESTA PARTE COMENTADA SE OCUPA DE MOSTRAR LA TABLA PERO NO LA DETECTA

/*$query = "SELECT * FROM usuarios";
$result = $conn->query($query);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

//Crea una tabla con los datos de la consulta
echo "<table>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['nombre']}</td>";
    echo "</tr>";
}

echo "</table>";



/*
//Prueba insercion datos : 
//$stmt
//$stmt = $conn->prepare("INSERT INTO vuelo (callsign, fecha, numero_pasajeros, pais_salida, pais_llegada) VALUES (?, ?, ?, ?, ?)");
$stmt = $conn->prepare("INSERT INTO vuelo (callsign) VALUES (?)");

// ^^^ PROBLEMA : devuelve un boolean por que hay algo mal ^^^
if (strcmp(gettype($conn), "boolean") == 0)
{
    echo "No va";
    //La comprobacion nos dice que es de tipo object
}


//$stmt->bind_param("ssiss", $callsign, $fecha, $numero_pasajeros, $pais_salida, $pais_salida);
//Al hacer bind_param da error : 
// Fatal error: Uncaught Error: Call to a member function bind_param() on boolean in /var/www/html/index.php:77 Stack trace: #0 {main} thrown in /var/www/html/index.php on line 77

$stmt->bind_param("s", $callsign);

//i - integer
//d - double
//s - string

$callsign = "Dragon";
//$fecha = "20022020";
//$numero_pasajeros = 3;
//$pais_salida = "Espana";
//$pais_salida = "Francia";
//$stmt->execute();


$conn->close();
*/



$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$dni = $_POST["dni"];
$telef = $_POST["telef"];
$fnacimiento = $_POST["fnacimiento"];
$email = $_POST["email"];
$contraseña = $_POST["contraseña"];

//meter datos tabla

$sql = "INSERT INTO usuarios (dni, nombre, apellidos, telefono, email, contraseña, nacimiento) VALUES ('$dni','$nombre','$apellidos','$telef','$email','$contraseña','$fnacimiento')";

if ($conn->query($sql) === TRUE){
	echo "Registrado con exito";
		$conn->close();
		exit;
} else {
	echo "Error: " . $conn->error;
		$conn->close(); 
}

?>
