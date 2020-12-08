<?php
include "connection.php";
include "navbar.php";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=wrapper>";
echo "<h1>Gehege</h1>";
$query = "SELECT gehege.gehege, gebaeude.gebaeude FROM gehege, gebaeude WHERE gebaeude.geb_id = gehege.geb_id";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);


while ($row = mysqli_fetch_array($result))
{
  $gehege[] = $row['gehege'];
  $gebaeude[] = $row['gebaeude'];
}


echo"<table style='width: 20%'><tr><th>Gehege</th><th>Gebäude</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
  echo "<td>$gehege[$i]</td>";
  echo "<td>$gebaeude[$i]</td>";
  echo"</tr>";
}
echo"</table>";

$query = "SELECT * FROM gebaeude";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result))
{
  $gebaeude[] = $row['gebaeude'];
  $gebaeudeID[] = $row['geb_id'];
}

?>

<html>
<h1>Gehege hinzufügen</h1>
<form method="post">
<label>Gehege: </label><br>
<input type="text" name="gehegeName" ></input><br><br>
<label>Gebäude: </label><br>
<select name=gebaeudeName> 
<?php
for ($i = 0; $i < $count; $i++)
{
  echo "<option value='$gebaeudeID[$i]'>$gebaeude[$i]</option>";
}
?>
</select><br><br>
<button name="speichern_gehege" >Speichern</button> 
</form>

</html>

<?php
if (isset($_POST["speichern_gehege"]))
{
  $sql = "INSERT INTO gehege (gehege, gehege.geb_id) VALUES ('$_POST[gehegeName]', '$_POST[gebaeudeName]')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}
echo "</div>";

?>