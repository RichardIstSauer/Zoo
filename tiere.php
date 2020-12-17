<?php
include "connection.php";
include "navbar.php";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=wrapper>";
echo "<h1>Tiere</h1>";
$query = "SELECT tiername, tierart, reviername, gehege.gehege, geschlecht, gebdat, abgabedatum FROM tier, tierart, revier, gehege WHERE tier.art_id=tierart.art_id AND tier.r_id=revier.r_id AND tier.g_id=gehege.g_id";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $tiername[] = $row['tiername'];
  $tierart[] = $row['tierart'];
  $revier[] = $row['reviername'];
  $gehege[] = $row['gehege'];
  $geschlecht[] = $row['geschlecht'];
  $gebdat [] = $row['gebdat'];
  $abgabedatum [] = $row['abgabedatum'];
}


echo"<table style='width: 50%'><tr><th>Name</th><th>Tierart</th><th>Revier</th><th>Gehege</th><th>Geschlecht</th><th>Geburtsdatum</th><th>Abgabedatum</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
  echo "<td>$tiername[$i]</td>";
  echo "<td>$tierart[$i]</td>";
  echo "<td>$revier[$i]</td>";
  echo "<td>$gehege[$i]</td>";
  echo "<td>$geschlecht[$i]</td>";
  echo "<td>$gebdat[$i]</td>";
  echo "<td>$abgabedatum[$i]</td>";
  echo"</tr>";
}
echo"</table>";

$query = "SELECT * FROM revier";
$result = mysqli_query($conn, $query);
$countRevier = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $revierIdDrop [] = $row['r_id'];
  $revierDrop [] = $row['reviername'];
  
}

// $query = "SELECT * FROM gehege";
// $result = mysqli_query($conn, $query);
// $countGehege = mysqli_num_rows($result);

// while ($row = mysqli_fetch_array($result)) {
//   $gehegeIdDrop [] = $row['g_id'];
//   $gehegeDrop [] = $row['gehege'];
  
// }

$query = "SELECT * FROM tierart";
$result = mysqli_query($conn, $query);
$countTierart = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $tierartIdDrop [] = $row['art_id'];
  $tierartDrop [] = $row['tierart'];
  
}

?>

<html>
<!-- tesst -->
<h1>Tier hinzufügen</h1>
<form method="post">
<label>Name:</label><br>
<input type="text" name="name"></input><br>
<label>Tierart:</label><br>
<select name="tierartSelect">
<?php
for ($i = 0; $i < $countTierart; $i++)
{
  echo "<option value='$tierartIdDrop[$i]'>$tierartDrop[$i]</option>";
}
?>
</select><br>
<label>Revier</label><br>
<select name="revierSelect">
<?php
for ($i = 0; $i < $countRevier; $i++)
{
  echo "<option value='$revierIdDrop[$i]'>$revierDrop[$i]</option>";
}
?> 
</select><br>
<label>Gehege</label><br>
<select name="gehegeSelect">
<?php
$query = "SELECT * FROM gehege WHERE r_id='$revierSelect'";
$result = mysqli_query($conn, $query);
$countGehege = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $gehegeIdDrop [] = $row['g_id'];
  $gehegeDrop [] = $row['gehege'];
  
}

for ($i = 0; $i < $countGehege; $i++)
{
  echo "<option value='$gehegeIdDrop[$i]'>$gehegeDrop[$i]</option>";
}
?> 
</select><br>
<label>Geschlecht:</label><br>
<select name=geschlechtSelect>
<option value="männlich">männlich</option>
<option value="weiblich">weiblich</option>
</select><br>
<label>Geburtsdatum: </label><br>
<input type="date" name="gebdat" ></input><br><br>
<button type="submit" name="speichern" >Speichern</button> 
</form>

</html>

<?php
if (isset($_POST["speichern"]))
{
  $sql = "INSERT INTO tier (tiername, art_id, r_id, g_id, geschlecht, gebdat) VALUES ('$_POST[name]','$_POST[tierartSelect]','$_POST[revierSelect]','$_POST[gehegeSelect]','$_POST[geschlechtSelect]','$_POST[gebdat]')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}

echo "</div>"
?>
