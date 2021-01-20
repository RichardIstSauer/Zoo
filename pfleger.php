<?php
include "connection.php";
include "navbar.php";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=wrapper>";
echo "<h1>Pfleger</h1>";
$query = "SELECT `vorname`,`nachname`,`geburtsdatum`,`adresse`,`telefonnummer`,`plz` FROM `pfleger`";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $vornamePfleger[] = $row['vorname'];
  $nachnamePfleger[] = $row['nachname'];
  $gebdatPfleger[] = $row['geburtsdatum'];
  $adressePfleger[] = $row['adresse'];
  $telefonnummerPfleger[] = $row['telefonnummer'];
  $plzPfleger [] = $row['plz'];
}


echo"<table style='width: 50%'><tr><th>Vorname</th><th>Nachname</th><th>Geburtsdatum</th><th>Telefonnummer</th><th>Adresse</th><th>PLZ</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
  echo "<td>$vornamePfleger[$i]</td>";
  echo "<td>$nachnamePfleger[$i]</td>";
  echo "<td>$gebdatPfleger[$i]</td>";
  echo "<td>$telefonnummerPfleger[$i]</td>";
  echo "<td>$adressePfleger[$i]</td>";
  echo "<td>$plzPfleger[$i]</td>";
  echo"</tr>";
}
echo"</table>";

$query = "SELECT * FROM ort";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $plzPflegerDrop [] = $row['plz'];
  $ortPflegerDrop [] = $row['ort'];
  
}

?>

<html>

<h1>Pleger hinzufügen</h1>
<form method="post">
<label>Vorname:</label><br>
<input type="text" name="vorname"></input><br>
<label>Nachname: </label><br>
<input type="text" name="nachname" ></input><br>
<label>Geburtsdatum: </label><br>
<input type="date" name="gebdat" ></input><br>
<label>Telefonnummer:  </label><br>
<input type="number" name="telefonnummer" min="1" max="99999999999999999"></input><br>
<label>Adresse: </label><br>
<input type="text" name="adresse" ></input><br>
<label>PLZ: </label><br>
<select name=plzPflegerSelect>
<?php
for ($i = 0; $i < $count; $i++)
{
  echo "<option value='$plzPflegerDrop[$i]'>$plzPflegerDrop[$i] - $ortPflegerDrop[$i]</option>";
}
?> 
</select><br><br>
<button type="submit" name="speichern_pfleger" >Speichern</button> 
</form>

</html>

<?php
if (isset($_POST["speichern_pfleger"]))
{
if (!empty($_POST['vorname']) && !empty($_POST['nachname']) && !empty($_POST['gebdat']) && !empty($_POST['telefonnummer']) && !empty($_POST['adresse']) && !empty($_POST['plzPflegerSelect']))
{
  $sql = "INSERT INTO pfleger (vorname, nachname, geburtsdatum, telefonnummer, adresse, plz) VALUES ('$_POST[vorname]','$_POST[nachname]','$_POST[gebdat]','$_POST[telefonnummer]','$_POST[adresse]','$_POST[plzPflegerSelect]')";
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
