<?php
include "connection.php";
include "navbar.php";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=container>";
echo "<h1>Extras</h1>";

include"9uhr.php";

$query = "SELECT * FROM gebaeude";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result))
{
  $gebaeudeDrop[] = $row['gebaeude'];
  $gebaeudeIdDrop[] = $row['geb_id'];
}

echo "</div>";


?>
