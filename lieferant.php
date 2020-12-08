<?php
include "connection.php";
include "navbar.php";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=wrapper>";
echo "<h1>Lieferant</h1>";
$query = "SELECT  lieferant , ansprechpartner , telefonnummer , adresse , plz  FROM  lieferant";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $lieferant[] = $row['lieferant'];
  $ansprechpartner[] = $row['ansprechpartner'];
  $telefonnummerLieferant[] = $row['telefonnummer'];
  $adresseLieferant[] = $row['adresse'];
  $plzLieferant [] = $row['plz'];
}


echo"<table ><tr><th>Lieferant</th><th>Ansprechpartner</th><th>Telefonnummer</th><th>Adresse</th><th>PLZ</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
  echo "<td>$lieferant[$i]</td>";
  echo "<td>$ansprechpartner[$i]</td>";
  echo "<td>$telefonnummerLieferant[$i]</td>";
  echo "<td>$adresseLieferant[$i]</td>";
  echo "<td>$plzLieferant[$i]</td>";
  echo"</tr>";
}
echo"</table>";

$query = "SELECT * FROM ort";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $plzLieferantDrop [] = $row['plz'];
  $ortLieferantDrop [] = $row['ort'];
  
}



?>

<html>

<h1>Lieferant hinzufügen</h1>
<form method="post">
<label>Lieferant: </label><br>
<input type="text" name="lieferantname" ></input><br>
<label>Ansprechpartner: </label><br>
<input type="text" name="ansprechpartner" ></input><br>
<label>Telefonnummer: </label><br>
<input type="text" name="telefonnummer_lieferant" ></input><br>
<label>Adresse: </label><br>
<input type="text" name="adresse_lieferant" ></input><br>
<label>PLZ: </label><br>
<select name=plzLieferantSelect>
<?php
for ($i = 0; $i < $count; $i++)
{
  echo "<option value='$plzLieferantDrop[$i]'>$plzLieferantDrop[$i] - $ortLieferantDrop[$i]</option>";
}
?> 
</select><br><br>
<button type="submit" name="speichern_lieferant" >Speichern</button> 
</form>

</html>

<?php


if (isset($_POST["speichern_lieferant"]))
{
  $sql = "INSERT INTO lieferant (lieferant, adresse, plz, ansprechpartner, telefonnummer) VALUES ('$_POST[lieferantname]', '$_POST[adresse_lieferant]',' $_POST[plzLieferantSelect]', '$_POST[ansprechpartner]',' $_POST[telefonnummer_lieferant]')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}

echo "</div>"
?>