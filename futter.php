<?php
include "connection.php";
include "navbar.php";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=wrapper>";
echo "<h1>Futter</h1>";
$query = "SELECT futter, gebaeude.gebaeude FROM futter, gebaeude WHERE futter.geb_id=gebaeude.geb_id";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $futter[] = $row['futter'];
  $gebaeude[] = $row['gebaeude'];
}


echo"<table style='width: 20%'><tr><th>Futter</th><th>Gebäude</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
  echo "<td>$futter[$i]</td>";
  echo "<td>$gebaeude[$i]</td>";
  echo"</tr>";
}
echo"</table>";


$query = "SELECT * FROM gebaeude";
$result = mysqli_query($conn, $query);
$countGebaeude = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $gebaeudeIdDrop [] = $row['geb_id'];
  $gebaeudeDrop [] = $row['gebaeude'];
  
}


?>

<html>
<h1>Futter hinzufügen</h1>
<form method="post">
<label>Futter:</label><br>
<input type="text" name="futter"></input><br>
<label>Gebäude</label><br>
<select name="gebaeudeSelect">
<?php
for ($i = 0; $i < $countGebaeude; $i++)
{
  echo "<option value='$gebaeudeIdDrop[$i]'>$gebaeudeDrop[$i]</option>";
}
?> 
</select><br><br>
<button type="submit" name="speichern" >Speichern</button> 
</form>

</html>

<?php
if (isset($_POST["speichern"]))
{
  $sql = "INSERT INTO futter (futter, geb_id) VALUES ('$_POST[futter]','$_POST[gebaeudeSelect]')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}

echo "</div>"
?>
