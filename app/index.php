
<link rel= stylesheet href=styles.css>

<?php
    include 'index.html';
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    // Intenta establecer la conexión
    $conn = new mysqli($hostname, $username, $password, $db);

    // Verifica si se produjo un error en la conexión
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
  
    echo "Da blutud dibais is conektidas saksesfuli";


$as = $conn->query("SELECT * FROM usuarios")

/*$query = mysqli_query($conn, "SELECT * FROM usuarios")
   or die (mysqli_error($conn));


echo "<table>";

while ($row = mysqli_fetch_array($as)) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['nombre']}</td>";
    echo "</tr>";
}

echo "</table>";
 */

?>
