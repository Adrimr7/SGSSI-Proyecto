<?php
include 'connection.php'; 

$email = $_POST["email"];
$contrasena = $_POST["contrasena"];

// SQL para buscar el usuario por email y contraseña
$sql = "SELECT COUNT(nombre) FROM usuarios WHERE email='$email' AND contraseña='$contrasena'";

$resultado = $conn->query($sql);

if ($resultado > 0) {
    
    // Si hay mas de 0 lineas quiere decir que ha habido una busqueda exitosa por lo que deberia de ser un inicio correcto por correo y contraseña
    echo "Inicio de sesión exitoso";
    include 'vuelos.php';
    $conn->close();
    exit;
    
} else {
    
    echo "Inicio de sesión fallido";    
    $conn->close(); 
    exit;
}
?>
