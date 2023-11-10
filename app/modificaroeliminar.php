<?php
session_start();
include 'connection.php';
include 'logger/mensajeLog.php';
if (!empty($_POST['csrf_token'])) {
	if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
		if (isset($_POST['accion']) && $_POST['accion'] === 'modificar') 
		{

			   if (isset($_POST['numcallsign'])) 
			   {
			     $_SESSION['callsign'] = $_POST["numcallsign"];
			   }
			   include 'modificarvuelo.html';
		}

		if (isset($_POST['accion']) && $_POST['accion'] === 'eliminar') 
		   {
		   	// Sentencia preparada para evitar SQL injection
		   	$calls = $_POST["numcallsign"];
			$sql = "DELETE FROM vuelo WHERE callsign = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("s", $calls);

			if ($stmt->execute()) {
			    $msg = "Vuelo con callsign: '$calls' eliminado.";
 			    echo '<script>mensajeLog("' . $msg . '");
 			    alert("Vuelo eliminado correctamente.");
          		    window.location.replace("vuelos.php")</script>';
    			    exit;
			} else {
			    $msg = "Error: " . $conn->error;
			    echo '<script>mensajeLog("' . $msg . '");</script>';
			}

			$stmt->close();
			$conn->close();
		 }
	}else{
	echo $_SESSION['csrf_token'];
	$msg = "Error con el CSRF Token, modificaroeliminar.php";
	echo '<script>mensajeLog("' . $msg . '");</script>';
	echo $_POST['csrf_token'];
	}
}else{

echo "Error token CSRF vacio";
}
?>
