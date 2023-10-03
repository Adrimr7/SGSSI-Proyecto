
<link rel= stylesheet href=styles.css>

<?php
include 'home.html';
$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";

// Intenta establecer la conexión
$conn = new mysqli($hostname, $username, $password, $db);

// Verifica si se produjo un error en la conexión
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

echo "La conexión a la base de datos se ha realizado con éxito";

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

/*

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

// Cierra la conexión
$conn->close();*/


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

*/
$conn->close();


?>
