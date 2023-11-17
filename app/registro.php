<?php
#header_remove('X-Powered-By');
//Iniciamos o continuamos la sesion de PHPs
session_start();
//Nos conectamos a la base de datos
include 'connection.php';
//Y pasamos a la pagina registro
include 'registro.html';
?>
