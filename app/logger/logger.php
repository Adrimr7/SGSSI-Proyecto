<?php
$msg = $_POST['message'];

$archivoLog =  "/var/log/logAvionair.txt";
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
// obtiene de donde viene la llamada, basename es para que no incluya localhost:81
$dedonde = isset($_SERVER['HTTP_REFERER']) ? basename($_SERVER['HTTP_REFERER']) : 'Desconocido';

$log = fopen($archivoLog, "a");

if ($log)
{
    $logMsg = "[" . date("Y-m-d H:i:s") . "] Archivo: " . $dedonde . ", Mensaje: " . $msg . "\n";
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

