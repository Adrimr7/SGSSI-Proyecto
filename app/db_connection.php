<?php
function OpenCon()
{

$hostname = "db";
$username = "admin";
$password = "test";
$db = "database";
$conn = new mysqli($hostname, $username, $password, $database) or die("Connect failed: %s\n". $conn -> error);
return $conn;
}
function CloseCon($conn)
{
$conn -> close();
}
?>
