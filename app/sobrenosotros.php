<?php
header_remove('X-Powered-By');
session_start();
include 'connection.php';
include 'sobrenosotros.html';
$conn->close();
?>
