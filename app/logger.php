<?php
$msg = $_POST['message']; // Obtén el mensaje de la solicitud POST
$archivoLog = __DIR__ . "/log.txt"; // Ruta absoluta al directorio raíz del servidor web

if (!file_exists($archivoLog)) {
    touch($archivoLog);
    $log = fopen($archivoLog, "w");
    if ($log) {
        fwrite($log, "Log Errores Avionair\n");
        fclose($log);
    } else {
        http_response_code(500); // Código de estado HTTP 500 (error)
        echo "Error al crear el archivo de registro.";
        exit;
    }
}

$log = fopen($archivoLog, "a");

if ($log)
{
    $logMsg = "[" . date("Y-m-d H:i:s") . "] " . $msg . "\n";
    fwrite($log, $logMsg);
    fclose($log);
    http_response_code(200);     // Codigo de estado HTTP 200 (OK)
    echo "Registro exitoso";
}
else
{
    http_response_code(500); // Codigo de estado HTTP 500 (error)
    echo "Error al abrir el archivo de registro.";
}
?>

