<?php echo '<script> function mensajeLog(msg) 
	       { 
			var xhr = new XMLHttpRequest();
        		xhr.open("POST", "../logger/logger.php", true);
        		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		xhr.send("message=" + msg); 
               }</script>';
               ?>
