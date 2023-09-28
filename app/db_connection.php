<?php
function OpenCon()
{
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    // Intenta establecer la conexión
    $conn = new mysqli($hostname, $username, $password, $db);

    // Verifica si se produjo un error en la conexión
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}
?>

