<?php
include "connection.php";
include "navbar.php";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=wrapper>";
echo "<h1>Lieferung</h1>";
$query = "SELECT futter.futter, lieferant.lieferant, lieferung.liefdat, lieferung.menge, lieferung.einheit FROM futter, lieferant, lieferung WHERE lieferung.f_id=futter.f_id AND lieferant.l_id=lieferung.l_id;";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $futter[] = $row['futter'];
  $lieferant[] = $row['lieferant'];
  $liefdat[] = $row['liefdat'];
  $menge[] = $row['menge'];
  $einheit[] = $row['einheit'];
  
}


echo"<table><tr><th>Futter</th><th>Lieferant</th><th>Lieferungsdatum</th><th>Menge</th><th>Einheit</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
  echo "<td>$futter[$i]</td>";
  echo "<td>$lieferant[$i]</td>";
  echo "<td>$liefdat[$i]</td>";
  echo "<td>$menge[$i]</td>";
  echo "<td>$einheit[$i]</td>";
  echo"</tr>";
}
echo"</table>";

$query = "SELECT * FROM lieferant";
$result = mysqli_query($conn, $query);
$countLieferant = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $lieferantDrop [] = $row['lieferant'];
  $lieferantIdDrop [] = $row['l_id'];
  
}

$query = "SELECT * FROM futter";
$result = mysqli_query($conn, $query);
$countFutter = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $futterDrop [] = $row['futter'];
  $futterIdDrop [] = $row['f_id'];
  
}

?>

<html>

<h1>Lieferung hinzufügen</h1>
<form method="post">
<label>Futter:</label><br>
<select name="futterSelect">
<?php
for ($i = 0; $i < $countFutter; $i++)
{
  echo "<option value='$futterIdDrop[$i]'>$futterDrop[$i]</option>";
}
?> 
</select><br>
<label>Lieferant: </label><br>
<select name="lieferantSelect">
<?php
for ($i = 0; $i < $countLieferant; $i++)
{
  echo "<option value='$lieferantIdDrop[$i]'>$lieferantDrop[$i]</option>";
}
?> 
</select><br>
<label>Lieferungsdatum: </label><br>
<input type="date" name="lieferungsdatum" ></input><br>
<label>Menge:  </label><br>
<input type="number" name="menge" min="1" max="10000"></input><br>
<label>Einheit: </label><br>
<select name=einheit>
<option value="mg">mg</option>
<option value="g">g</option>
<option value="kg">kg</option>
</select><br><br>
<button type="submit" name="speichern" >Speichern</button> 
</form>
</html>

<?php
if (isset($_POST["speichern"]))
{
  if (!empty($_POST['futterSelect']) && !empty($_POST['lieferantSelect']) && !empty($_POST['lieferungsdatum']) && !empty($_POST['menge']) && !empty($_POST['einheit']))
  {
    $sql = "INSERT INTO lieferung (f_id, l_id, liefdat, menge, einheit) VALUES ('$_POST[futterSelect]','$_POST[lieferantSelect]','$_POST[lieferungsdatum]','$_POST[menge]','$_POST[einheit]')";
    if ($conn->query($sql) == FALSE)
    {
    echo "Fehler beim Einfügen: " . $conn->error;
    }
  }

  else
  {
    echo "Fehler beim Einfügen: Einige Eingabefelder sind leer";
  }
}

echo "</div>"
?>
