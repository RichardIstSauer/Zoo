<?php
include "connection.php";
include "navbar.php";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=wrapper>";
echo "<h1>Tierarten</h1>";
$query = "SELECT * FROM tierart";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $tierart[] = $row['tierart'];
}


echo"<table style='width: 20%'><tr><th>Tierarten</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
  echo "<td>$tierart[$i]</td>";
  echo"</tr>";
}
echo"</table>";

?>

<html>
<h1>Tierart hinzufügen</h1>
<form method="post">
<label>Tierart:</label><br>
<input type="text" name="tierart"></input><br><br>
<button type="submit" name="speichern" >Speichern</button> 
</form>

</html>

<?php
if (isset($_POST["speichern"]))
{
  $sql = "INSERT INTO tierart (tierart) VALUES ('$_POST[tierart]')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}

echo "</div>"
?>
