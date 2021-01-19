<?php
include "connection.php";
include "navbar.php";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=wrapper>";
echo "<h1>Futterplan</h1>";
$query = "SELECT tier.tiername, tierart.tierart, revier.reviername, gehege.gehege, futter.futter, fuetterung.menge, fuetterung.einheit, fuetterung.uhrzeit, fuetterung.wochentag FROM revier, gehege, tier, fuetterung, tierart, futter WHERE fuetterung.t_id=tier.t_id AND revier.r_id=tier.r_id AND gehege.g_id=tier.g_id AND tier.art_id=tierart.art_id";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $tier[] = $row['tiername'];
  $tierart[] = $row['tierart'];
  $revier[] = $row['reviername'];
  $gehege[] = $row['gehege'];
  $futter[] = $row['futter'];
  $menge[] = $row['menge'];
  $einheit[] = $row['einheit'];
  $uhrzeit[] = $row['uhrzeit'];
  $wochentag [] = $row['wochentag'];
}


echo"<table style='width: 50%'><tr><th>Tiername</th><th>Tierart</th><th>Revier</th><th>Gehege</th><th>Futter</th><th>Menge</th><th>Einheit</th></th><th>Uhrzeit</th></th><th>Wochentag</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
  echo "<td>$tier[$i]</td>";
  echo "<td>$tierart[$i]</td>";
  echo "<td>$revier[$i]</td>";
  echo "<td>$gehege[$i]</td>";
  echo "<td>$futter[$i]</td>";
  echo "<td>$menge[$i]</td>";
  echo "<td>$einheit[$i]</td>";
  echo "<td>$uhrzeit[$i]</td>";
  echo "<td>$wochentag[$i]</td>";
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

$query = "SELECT * FROM futter";
$result = mysqli_query($conn, $query);
$countFutter = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $futterIdDrop [] = $row['f_id'];
  $futter [] = $row['futter'];
}

?>

<html>
<h1>Geplante Fütterung hinzufügen</h1>
<form method="post">
<label>Tier:</label><br>
<select name="tierSelect">
<?php
for ($i = 0; $i < $countTier; $i++)
{
  echo "<option value='$tierIdDrop[$i]'>$tierDrop[$i] - $tierartDrop[$i]</option>";
}
?>
</select><br>
<label>Futter:</label><br>
<select name="futterSelect">
<?php
for ($i = 0; $i < $countFutter; $i++)
{
  echo "<option value='$futterIdDrop[$i]'>$futter[$i]</option>";
}
?>
</select><br>
<label>Menge:</label><br>
<input type="number" name="menge" min="1" max="10000"></input><br>
<label>Einheit:</label><br>
<select name="einheitSelect">
<option value="mg">mg</option>    
<option value="g">g</option>
<option value="kg">kg</option>
</select><br>
<label>Uhrzeit: </label><br>
<input type="time" name="uhrzeit" ></input><br>
<label>Wochentag:</label><br>
<select name=wochentagSelect>
<option value="Montag">Montag</option>
<option value="Dienstag">Dienstag</option>
<option value="Mittwoch">Mittwoch</option>
<option value="Donnerstag">Donnerstag</option>
<option value="Freitag">Freitag</option>
<option value="Samstag">Samstag</option>
<option value="Sonntag">Sonntag</option>
</select><br><br>
<button type="submit" name="speichern" >Speichern</button> 
</form>
</html>

<?php
if (isset($_POST["speichern"]))
{
  if (!empty($_POST['tierSelect']) && !empty($_POST['futterSelect']) && !empty($_POST['menge']) && !empty($_POST['einheitSelect']) && !empty($_POST['uhrzeit']) && !empty($_POST['wochentagSelect']))
  {
    $sql = "INSERT INTO fuetterung (t_id, f_id, menge, einheit, uhrzeit, wochentag) VALUES ('$_POST[tierSelect]','$_POST[futterSelect]','$_POST[menge]','$_POST[einheitSelect]','$_POST[uhrzeit]','$_POST[wochentagSelect]')";
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
