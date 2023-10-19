<?php
session_start();
include 'connection.php'; 

$dni = $_POST["dni"];
$contrasena = $_POST["contrasena"];

// SQL para buscar el usuario por email y contraseña
//$sql = "SELECT COUNT(nombre) FROM usuarios WHERE email='$email' AND contraseña='$contrasena'";
$sql = "SELECT * FROM usuarios WHERE dni='$dni' AND contraseña='$contrasena'";
$resultado = $conn->query($sql);
$num_resultados = $resultado->num_rows; //Se hace una consulta y luego se cuentan las filas, con COUNT no deja

if ($num_resultados > 0) {
    // Si hay mas de 0 lineas quiere decir que ha habido una busqueda exitosa por lo que deberia de ser un inicio correcto por correo y contraseña
    session_start();
    $_SESSION['autenticado'] = true;
    $_SESSION['dni'] = $dni;
    include 'vuelos.php';
    exit;
    
} 
else {
    
    include 'iniciosesion.php';
    exit;
}
$conn->close(); 
?>
