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

echo "<h1>Pfleger</h1>";
$query = "SELECT `gehege`,`nachname`,`geburtsdatum`,`adresse`,`telefonnummer`,`plz` FROM `pfleger`";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $vornamePfleger[] = $row['vorname'];
  $nachnamePfleger[] = $row['nachname'];
  $gebdatPfleger[] = $row['geburtsdatum'];
  $adressePfleger[] = $row['adresse'];
  $telefonnummerPflege[] = $row['telefonnummer'];
  $plzPfleger [] = $row['plz'];
}


echo"<table style='width: 30%'><tr><th>Vorname</th><th>Nachname</th><th>Geburtsdatum</th><th>Telefonnummer</th><th>Adresse</th><th>PLZ</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
  echo "<td>$vornamePfleger[$i]</td>";
  echo "<td>$nachnamePfleger[$i]</td>";
  echo "<td>$gebdatPfleger[$i]</td>";
  echo "<td>$adressePfleger[$i]</td>";
  echo "<td>$telefonnummerPflege[$i]</td>";
  echo "<td>$plzPfleger[$i]</td>";
  echo"</tr>";
}
echo"</table>";

?>

<html>

<h1>Gehege hinzufügen</h1>
<form method="post">
<label>Gehege: </label><br>
<input type="text" name="gehegeName" ></input><br>
<button type="submit" name="speichern_gehege" >Speichern</button> 
</form>

</html>

<?php
if (isset($_POST["speichern_gehege"]))
{
  $sql = "INSERT INTO gehege (gehege, adresse, plz, ansprechpartner) VALUES ('".$_POST["lieferantname"]."', '".$_POST["adresse_lieferant"]."', '".$_POST["plz_lieferant"]."', '".$_POST["ansprechpartner"]."')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}
?>
