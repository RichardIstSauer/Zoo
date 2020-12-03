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
$query = "SELECT `vorname`,`nachname`,`geburtsdatum`,`adresse`,`telefonnummer`,`plz` FROM `pfleger`";
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


echo"<table style='width: 50%'><tr><th>Vorname</th><th>Nachname</th><th>Geburtsdatum</th><th>Telefonnummer</th><th>Adresse</th><th>PLZ</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
  echo "<td>$vornamePfleger[$i]</td>";
  echo "<td>$nachnamePfleger[$i]</td>";
  echo "<td>$gebdatPfleger[$i]</td>";
  echo "<td>$telefonnummerPflege[$i]</td>";
  echo "<td>$adressePfleger[$i]</td>";
  echo "<td>$plzPfleger[$i]</td>";
  echo"</tr>";
}
echo"</table>";

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
<input type="text" name="telefonnummer" ></input><br>
<label>Adresse: </label><br>
<input type="text" name="adresse" ></input><br>
<label>PLZ: </label><br>
<input type="text" name="plz_pfleger" ></input><br><br>
<button type="submit" name="speichern_pfleger" >Speichern</button> 
</form>

</html>

<?php
if (isset($_POST["speichern_pfleger"]))
{
  $sql = "INSERT INTO pfleger (vorname, nachname, geburtsdatum, telefonnummer, adresse, plz) VALUES ('".$_POST["vorname"]."','".$_POST["nachname"]."','".$_POST["gebdat"]."','".$_POST["telefonnummer"]."','".$_POST["adresse"]."', '".$_POST["plz_pfleger"]."')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}
?>
