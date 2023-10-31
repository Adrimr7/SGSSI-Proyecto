<?php
session_start();
include 'connection.php';

// Obtenemos los datos del submit usando los id de cada apartado
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$dni = $_POST["dni"];
$telef = $_POST["telef"];
$fnacimiento = $_POST["fnacimiento"];
$email = $_POST["email"];
$contraseña = $_POST["contraseña"];

$salt = generarSalt();
$contraseñaConSalt = $contraseña . $salt;
$hash = generarHash($contraseñaConSalt);

// Preparamos la instrucción SQL con los datos del formulario
$sql = "INSERT INTO usuarios (dni, nombre, apellidos, telefono, email, contraseña, salt, nacimiento) VALUES ('$dni','$nombre','$apellidos','$telef','$email','$hash','$salt','$fnacimiento')";

// A través del objeto de conexión $conn, ejecutamos query() para enviar la instrucción SQL
if ($conn->query($sql) === TRUE) {
    // Teniendo el usuario registrado, cerramos la conexión a la base de datos
    $conn->close();
    include 'iniciosesion.php';
    exit;
} else {
    echo "Error: " . $conn->error;
    $conn->close();
}

function generarHash($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function generarSalt() {
    return bin2hex(random_bytes(16)); // Genera una salt de 16 bytes y la convierte en una cadena hexadecimal
}
?>

