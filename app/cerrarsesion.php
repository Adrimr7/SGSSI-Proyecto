<?php
#header_remove('X-Powered-By');
session_start();
session_unset();
session_destroy();
header('Location: index.php'); 

exit();
?>

