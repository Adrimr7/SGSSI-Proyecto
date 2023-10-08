
<link rel= stylesheet href=styles.css>

<?php
include 'connection.php';

//Aqui navbar

echo '
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO- AVIONAIR</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="Logo1.png" type="image/png">
</head>

<body>

    <header id="main-header">
        <div class="titulo">
            <h1>Vuelos</h1>
        </div>
        <div class="logo">
            <a href="home.html"> <img src="img/brand-logo.png" alt="Avionair Logo"></a>
        </div>
        <nav> 
            <ul class="navbar">
                <li class="elem"> <a class="link" href="index.php">HOME </a></li>
                <li class="elem" style="background-color: rgb(105, 105, 188);"> <a class="link" href="vuelos.php">VUELOS </a></li>
                <li class="elem"> <a class="link" href="iniciosesion.php">INICIO DE SESIÓN </a></li>
                <li class="elem"> <a class="link" href="registro.php">REGISTRO </a></li>
                <li class="elem"> <a class="link" href="sobrenosotros.html">SOBRE NOSOTROS </a></li>
            </ul>
        </nav>
    </header>
</body>
</html>
';



$nombre = $_POST["ciudad"];


//meter datos tabla

$sql = "INSERT INTO ciudad (nombre) VALUES ('$nombre')";

if ($conn->query($sql) === TRUE){
	echo "Ciudad introducida correctamente.";
		$conn->close();
		exit;
} else {
	echo "Error: " . $conn->error;
		$conn->close(); 
}

?>
