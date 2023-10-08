
<link rel= stylesheet href=styles.css>

<?php
include 'connection.php';
include 'navbar.html';


//ESTA PARTE SE OCUPA DE MOSTRAR LA TABLA

$query = "SELECT * FROM vuelo";
$result = $conn->query($query);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

//Crea una tabla con los datos de la consulta
echo "<table>";
echo "<div class='lista'>";
$i = 0;
while ($row = $result->fetch_assoc()) 
{
    echo "<div id='Avion$i' class='avion caja texto' style='width: 200px; height: 150px;'>
            <div class='div-imagen'>
                <p>
                    <b>Origen:</b> {$row['ciudad_salida']}<br>
                    <b>Destino:</b> {$row['ciudad_llegada']}<br>
                    <b>CallSign:</b> {$row['callsign']}<br>
                    <b>Nº Pasajeros:</b> {$row['numero_pasajeros']}<br>
                    <b>Fecha:</b> {$row['fecha']}<br>
                </p>
            </div>
        </div>";

    $i = $i+1;
}

$conn->close();

include 'vuelos.html';

?>
