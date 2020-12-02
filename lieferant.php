<?php
include "connection.php";
include "navbar.php";

echo"<style>
  table, th, td
  {
  width: fit-content;
  border: 1px solid black;
  border-collapse: collapse;
  }
</style>";

echo "<h1>Lieferant</h1>";
$query = "SELECT `lieferant`,`ansprechpartner`,`telefonnummer`,`adresse`,`plz` FROM `lieferant`";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $lieferant[] = $row['lieferant'];
  $ansprechpartner[] = $row['ansprechpartner'];
  $telefonnummerLieferant[] = $row['telefonnummer'];
  $adresseLieferant[] = $row['adresse'];
  $plzLieferant [] = $row['plz'];
}


echo"<table style='width: 30%'><tr><th>Lieferant</th><th>Ansprechpartner</th><th>Telefonnummer</th><th>Adresse</th><th>PLZ</th></tr>";

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

?>

<html>

<h1>Lieferant hinzufügen</h1>
<form method="post">
<label>Lieferant: </label><br>
<input type="text" name="lieferantname" ></input><br>
<label>Adresse: </label><br>
<input type="text" name="adresse_lieferant" ></input><br>
<label>PLZ: </label><br>
<input type="text" name="plz_lieferant" ></input><br>
<label>Ansprechpartner: </label><br>
<input type="text" name="ansprechpartner" ></input><br><br>
<button type="submit" name="speichern_lieferant" >Speichern</button> 
</form>

</html>

<?php


if (isset($_POST["speichern_lieferant"]))
{
  $sql = "INSERT INTO lieferant (lieferant, adresse, plz, ansprechpartner) VALUES ('".$_POST["lieferantname"]."', '".$_POST["adresse_lieferant"]."', '".$_POST["plz_lieferant"]."', '".$_POST["ansprechpartner"]."')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}


