
<link rel= stylesheet href=styles.css>

<?php
  include 'index.html';

  // phpinfo();
  include 'db_connection.php';
  $conn = OpenCon();


  if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
  }
   echo "Connected Successfully";



$query = mysqli_query($conn, "SELECT * FROM usuarios")
   or die (mysqli_error($conn));

while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td>{$row['id']}</td>
    <td>{$row['nombre']}</td>
   </tr>";
   

}
  CloseCon($conn);
?>
