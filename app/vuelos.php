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
    echo "<div id='Avion$i' class='avion caja texto' style='width: 200px; height: 220px;'>
            <div class='div-imagen'>
                
                <!-- Para cada elemento del vuelo, lo obtenemos de row y lo ponemos en esta especie de tabla-->
                
                <form id= 'origen$i' method='POST' action = 'modificarvuelo.php'>
                <input type='hidden' name='origen' value='{$row['ciudad_salida']}'>
                    <b>Origen:</b> {$row['ciudad_salida']}<br>
                </form>
                
                <form id= 'destino$i' method='POST' action = 'modificarvuelo.php'>
                <input type='hidden' name='destino' value='{$row['ciudad_llegada']}'>
                    <b>Destino:</b> {$row['ciudad_llegada']}<br>
                </form>

                    <!-- Como no sabia como pasar el callsign a php, he hecho que sea un form de un unico elemento y luego se hace submit del form-->
                    <!-- permitiendo tener el valor en el php, pero me da que no cuela-->
                    
                    <form id= 'callsign$i' method='POST' action = 'eliminarvuelo.php'> 
                    	<input type='hidden' name='numcallsign' value='{$row['callsign']}'>
                        <b>CallSign:</b> <i id='callsign'>{$row['callsign']}</i><br>
                    </form>
		
	       <form id= 'pasajeros$i' method='POST' action = 'modificarvuelo.php'>
	       <input type='hidden' name='numero_pasajeros' value='{$row['numero_pasajeros']}'>
                    <b>Nº Pasajeros:</b> {$row['numero_pasajeros']}<br>
               </form>
               <form id= 'fecha$i' method='POST' action = 'modificarvuelo.php'>
               <input type='hidden' name='fecha' value='{$row['fecha']}'>
                    <b>Fecha:</b> {$row['fecha']}<br>
	       </form>

                    <!-- Botones de editar y de eliminar-->
                    <button class='input' type='button' id='botModificar$i'>Modificar</button>
                    <button class='input' type='button' id='botEliminar$i'>Eliminar</button>

                    
                    <!-- Este es el intendo de eliminar y modificar vuelos, detecta cuando pulsas, pero falta pasar la informacion a php para borrar -->
                    <!-- o modificar de la base de datos-->
                    <script>
                    document.getElementById('botModificar$i').addEventListener('click', function() 
                    {
                    	var form = document.getElementById('origen$i');
                    	var form1 = document.getElementById('destino$i');
                    	var form2 = document.getElementById('callsign$i');
                    	var form3 = document.getElementById('pasajeros$i');
                    	var form4 = document.getElementById('fecha$i');
        		form.submit();
        		form1.submit();
        		form2.submit();
        		form3.submit();
        		form4.submit();
                    	        	
                    });
                    </script>

                    <script>
			document.getElementById('botEliminar$i').addEventListener('click', function() {
    			//Aqui pide confirmacion antes de '''''eliminar''''' el vuelo
    			if (confirm('El vuelo {$row['callsign']} se va a eliminar')) {
        			// Buscar el formulario y enviarlo
        			var form = document.getElementById('callsign$i');
        			form.submit();
    			} 
    			else {}
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
