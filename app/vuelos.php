<?php
session_start();
include 'connection.php';

//Ponemos la cabecera de la pagina
include 'navbar.html';


//ESTA PARTE SE OCUPA DE MOSTRAR LA TABLA

//Preparamos la instruccion
$query = "SELECT * FROM vuelo";
//Y la ejecutamos
$result = $conn->query($query);

//Comprobamos que el resultado sea correcto
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

//Crea una tabla con los datos de la consulta
echo "<table>";
echo "<div class='lista'>";
$i = 0;

//fetch_assoc() dos devuelve para cada vuelta del while una fila del conjunto de resultados, en este caso, de los diferentes vuelos
//Entonces row contiene los datos de un vuelo
while ($row = $result->fetch_assoc()) 
{
    if (!isset($_SESSION['csrf_token'])){
	       $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
	       }
	       $csrf_token = $_SESSION['csrf_token'];	
    echo "<div id='Avion$i' class='avion caja texto' style='width: 200px; height: 220px;'>
            <div class='div-imagen'>
                
                <form id= 'vueloForm' method ='POST' action ='modificaroeliminar.php'>
                    <input type='hidden' name='origen' value='{$row['ciudad_salida']}'>
                    <b>Origen:</b> {$row['ciudad_salida']}<br>
                                
                    <input type='hidden' name='destino' value='{$row['ciudad_llegada']}'>
                    <b>Destino:</b> {$row['ciudad_llegada']}<br>

                    <input type='hidden' name='numcallsign' value='{$row['callsign']}'>
                    <b>CallSign:</b> <i id='callsign'>{$row['callsign']}</i><br>
                		
	            <input type='hidden' name='numero_pasajeros' value='{$row['numero_pasajeros']}'>
                    <b>Nº Pasajeros:</b> {$row['numero_pasajeros']}<br>

                    <input type='hidden' name='fecha' value='{$row['fecha']}'>
                    <b>Fecha:</b> {$row['fecha']}<br>
                    
		   <input type='hidden' name='csrf_token' value= $csrf_token>

                    <button class='input' type='submit' id='botModificar$i' name='accion' value = 'modificar' >Modificar</button>
                    <button class='input' type='submit' id='botEliminar$i' name='accion' value = 'eliminar' >Eliminar</button>
            </form> 
            <script>
                document.getElementById('botModificar$i').addEventListener('click', function() 
                {
                    
                    document.getElementById('botModificar$i').submit();
                });
                document.getElementById('botEliminar$i').addEventListener('click', function() 
                {
                    if (confirm('El vuelo {$row['callsign']} se va a eliminar')) {
                    	document.getElementById('botEliminar$i').submit();
                    }
                    else
                    {
                        event.preventDefault();
                    }
                    
                });
            </script>
            </div>
        </div>
        
        ";

    $i = $i+1;
}

$conn->close();

//Aqui añadimos el codigo en vuelos.html que nos permitira añadir vuelos
include 'vuelos.html';

?>
