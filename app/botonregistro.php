
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
            <h1>Registro</h1>
        </div>
        <div class="logo">
            <a href="home.html"> <img src="img/brand-logo.png" alt="Avionair Logo"></a>
        </div>
        <nav> 
            <ul class="navbar">
                <li class="elem"> <a class="link" href="index.php">HOME </a></li>
                <li class="elem"> <a class="link" href="vuelos.php">VUELOS </a></li>
                <li class="elem"> <a class="link" href="iniciosesion.php">INICIO DE SESIÓN </a></li>
                <li class="elem" style="background-color: rgb(105, 105, 188);"> <a class="link" href="registro.php">REGISTRO </a></li>
                <li class="elem"> <a class="link" href="sobrenosotros.html">SOBRE NOSOTROS </a></li>
            </ul>
        </nav>
    </header>
</body>
</html>
';
//Comprobacion



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
		$conn->close();
		echo "<h1>Usuario $nombre con DNI: $dni con fecha de nacimiento de $fnacimiento registrado correctamente</h1>";
		exit;
} else {
	echo "Error: " . $conn->error;
		$conn->close(); 
}

?>
