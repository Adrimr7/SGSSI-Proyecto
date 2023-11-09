<?php
echo '<script>alert("Entra en el logger.");</script>';
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

$log = fopen($archivoLog, "a");

if ($log)
{
    $logMsg = "[" . date("Y-m-d H:i:s") . "] " . $msg . "\n";
    echo '<script>alert("Probando... ");</script>';
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

