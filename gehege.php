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

echo "<h1>Gehege</h1>";
$query = "SELECT gehege.gehege, gebaeude.gebaeude FROM gehege, gebaeude WHERE gebaeude.geb_id = gehege.geb_id";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);


while ($row = mysqli_fetch_array($result))
{
  $gehege[] = $row['gehege'];
  $gebaeude[] = $row['gebaeude'];
}


echo"<table style='width: 30%'><tr><th>Gehege</th><th>Gebäude</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
  echo "<td>$gehege[$i]</td>";
  echo "<td>$gebaeude[$i]</td>";
  echo"</tr>";
}
echo"</table>";

$query = "SELECT gebaeude FROM gebaeude";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result))
{
  $gebaeudeAuswahl[] = $row['gebaeude'];
}

?>

<html>
<h1>Gehege hinzufügen</h1>
<form method="post">
<label>Gehege: </label><br>
<input type="text" name="gehegeName" ></input><br><br>
<label>Gebäude: </label><br>
<select name="gebaeudeSelect">
<?php
for ($i = 0; $i < $count; $i ++)
{
  echo "<option>".$gebaeudeAuswahl[$i]."</option>";
}
?>
</select><br><br> 
<button type="submit" name="speichern_gehege" >Speichern</button> 
</form>

</html>

<?php
if (isset($_POST["speichern_gehege"]))
{
  $value = $_POST["gebaeudeSelect"];
  $sql = "SELECT gebaeude.geb_id FROM gebaeude WHERE gebaeude='$value'";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);

  while ($row = mysqli_fetch_array($result))
  {
  $gebaeudeAuswahlID = $row['geb_id'];
  }

  $sql = "INSERT INTO gehege (gehege, gehege.geb_id) VALUES ('$_POST[gehegeName]', '$gebaeudeAuswahlID')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}
?>
