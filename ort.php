<?php
include "connection.php";
include "navbar.php";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=wrapper>";
echo "<h1>Orte</h1>";
$query = "SELECT `ort`,`plz` FROM `ort`";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $ort[] = $row['ort'];
  $plz[] = $row['plz'];
}


echo"<table><tr><th>Ort</th><th>PLZ</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
  echo "<td>$ort[$i]</td>";
  echo "<td>$plz[$i]</td>";
  echo"</tr>";
}
echo"</table>";

?>

<html>
<h1>Ort hinzufügen</h1>
<form method="post">
<label>Ortsname: </label><br>
<input type="text" name="ort" ></input><br>
<label>PLZ: </label><br>
<input type="number" name="plz_ort" min="01067" max="99999"></input><br><br>
<button type="submit" name="speichern" >Speichern</button> 
</form>

</html>


<?php

if (isset($_POST["speichern"]))
{
  if (!empty($_POST['ort']) && !empty($_POST['plz_ort']))
  {
    $sql = "INSERT INTO ort (ort, plz) values ('$_POST[ort]','$_POST[plz_ort]')";
    if ($conn->query($sql) == FALSE)
    {
    echo "Fehler beim Einfügen: " . $conn->error;
    }
  }
  else
  {
    echo "Fehler beim Einfügen: Einige der Eingabefelder sind leer";
  }
 
}


echo "</div>"
?>
