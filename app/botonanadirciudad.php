<?php
session_start();
include 'connection.php';

//Aqui navbar

$nombre = $_POST["ciudad"];
echo $_SESSION['csrf_token'];
if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {


	//meter datos tabla

	$sql = "INSERT INTO ciudad (nombre) VALUES ('$nombre')";

	if ($conn->query($sql) === TRUE){

		echo '<script> alert("Ciudad introducida correctamente.");</script>';
		echo '<script> window.location.replace("vuelos.php");</script>';



		exit;
		$conn->close();
			
	} else {
		echo "Error: " . $conn->error;
		$conn->close(); 
	}
}else{
echo $_SESSION['csrf_token'];
echo "Error con el token CSRF";
echo $_POST['csrf_token'];
}
?>
