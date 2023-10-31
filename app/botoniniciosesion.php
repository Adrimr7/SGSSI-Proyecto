<?php
session_start();
include 'connection.php';

$dni = $_POST["dni"];
$contraseña = $_POST["contrasena"];

// Preparar la consulta para recuperar el hash y la salt
$sql = "SELECT contraseña, salt FROM usuarios WHERE dni = ?";

if ($consulta = $conn->prepare($sql)) {
    $consulta->bind_param("s", $dni);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $hashAlmacenado = $fila['contraseña'];
        $saltAlmacenado = $fila['salt'];

        // Concatenar la contraseña proporcionada con la salt almacenada
        $contraseñaConSalt = $contraseña . $saltAlmacenado;

        if (password_verify($contraseñaConSalt, $hashAlmacenado)) {
            // Contraseña verificada con éxito
            // Inicia la sesión y realiza las acciones necesarias
            session_start();
            $_SESSION['autenticado'] = true;
            $_SESSION['dni'] = $dni;
            include 'vuelos.php';
            exit;
        } else {
            echo '<script> alert("Contraseña incorrecta.");</script>';
            include 'iniciosesion.php';
            exit;
        }
    } else {
        echo '<script> alert("Usuario no registrado.");</script>';
        include 'iniciosesion.php';
        exit;
    }
} else {
    // Gestion de errores de la consulta
    echo '<script> alert("Error en la consulta");</script>';
}
function generateHash($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}
$consulta->close();
$conn->close();
?>

