<?php
include "connection.php";
include "navbar.php";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=wrapper>";
echo "<h1>Gehege-Belegung</h1>";
$query = "SELECT tier.tiername, tierart.tierart, gehege.gehege FROM tier, tierart, gehege WHERE gehege.g_id=tier.g_id AND tier.art_id=tierart.art_id;;";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $tier[] = $row['tiername'];
  $tierart[] = $row['tierart'];
  $gehege[] = $row['gehege'];
}


echo"<table><tr><th>Tiername</th><th>Tierart</th><th>Gehege</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
  echo "<td>$tier[$i]</td>";
  echo "<td>$tierart[$i]</td>";
  echo "<td>$gehege[$i]</td>";
  echo"</tr>";
}
echo"</table>";

$query = "SELECT tier.t_id, tiername, tierart FROM tier, tierart WHERE tier.art_id=tierart.art_id";
$result = mysqli_query($conn, $query);
$countTier = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $tierIdDrop [] = $row['t_id'];
  $tierDrop [] = $row['tiername'];
  $tierartDrop [] = $row['tierart'];
}

$query = "SELECT * FROM gehege";
$result = mysqli_query($conn, $query);
$countGehege = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $gehegeDrop [] = $row['gehege'];
  $gehegeIdDrop [] = $row['g_id'];
  
}

echo "</div>"
?>


