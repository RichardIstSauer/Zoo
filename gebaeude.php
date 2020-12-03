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

echo "<h1>Gebäude</h1>";
$query = "SELECT `gebaeude` FROM `gebaeude`";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $gebaeude [] = $row['gebaeude'];
}


echo"<table style='width: 20%'><tr><th>Gebäude</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
  echo "<td>$gebaeude[$i]</td>";
  echo"</tr>";
}
echo"</table>";

?>

<html>

<h1>Gebäude hinzufügen</h1>
<form method="post">
<label>Gebäude: </label><br>
<input type="text" name="gebaeudeName" ></input><br><br>
<button type="submit" name="speichern_gebaeude" >Speichern</button> 
</form>


</html>

<?php
if (isset($_POST["speichern_gebaeude"]))
{
  $sql = "INSERT INTO gebaeude (gebaeude) VALUES ('".$_POST["lieferantname"]."')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}
?>
