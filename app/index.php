<?php
//Iniciamos la sesion de PHP 
header_remove('X-Powered-By');

session_start();
//Ejecuta el archivo connection.php
include 'connection.php';      
//Y lo mismo para la pagina HOME
include 'home.html';
//Cerramos la conexion con la base de datos
$conn->close();

?>
