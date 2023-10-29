<?php
session_start();
include 'connection.php'; 

$dni = $_POST["dni"];
$contrasena = $_POST["contrasena"];

// SQL para buscar el usuario por email y contraseña
//$sql = "SELECT COUNT(nombre) FROM usuarios WHERE email='$email' AND contraseña='$contrasena'";
if($consulta = $conn->prepare("SELECT * FROM usuarios WHERE dni = ? AND contraseña = ?")){
   $consulta->bind_param("ss", $dni, $contrasena);

   $dni = $_POST["dni"];
   $contrasena = $_POST["contrasena"];
   
   $consulta->execute();
   $resultado = $consulta->get_result();
   $num_resultados = $resultado->num_rows;
   
   if ($num_resultados > 0) {
    // Si hay mas de 0 lineas quiere decir que ha habido una busqueda exitosa por lo que deberia de ser un inicio correcto por correo y contraseña
    session_start();
    $_SESSION['autenticado'] = true;
    $_SESSION['dni'] = $dni;
    include 'vuelos.php';
    exit;
    
   } else {
    echo '<script> alert("Usuario no registrado.");</script>';
    echo '<script> alert($num_resultados);</script>';
    include 'iniciosesion.php';
    exit;
   }

} else {

 //Gestion de errores de la consulta
 echo '<script> alert("Error en la consulta");</script>';
}

$consulta->close();
$conn->close(); 
?>
