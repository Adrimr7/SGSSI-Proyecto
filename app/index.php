
<link rel= stylesheet href=styles.css>

<?php
  include 'db_connection.php';

  
  $conn = OpenCon();


  if ($conn->connect_error) 
  {
    die("Database connection failed: " . $conn->connect_error);
  }
   echo "Da blutud dibais is conektidas saksesfuli";



$query = mysqli_query($conn, "SELECT * FROM usuarios")
   or die (mysqli_error($conn));

echo "<table>"; 

while ($row = mysqli_fetch_array($query)) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['nombre']}</td>";
    echo "</tr>";
}

echo "</table>";
   
CloseCon($conn);

?>
