<?php
session_start();
//header("Content-Security-Policy: default-src 'self';");
include 'connection.php';
include 'iniciosesion.html';
$conn->close();
?>
