<?php
include "connection.php";
include "navbar.php";
echo "<link rel='stylesheet' href='styles.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=wrapper>";
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
<button type="submit" name="speichern" >Speichern</button> 
</form>


</html>

<?php
if (isset($_POST["speichern"]))
{
  if(!empty($_POST['gebaeudeName']))
  {
    $sql = "INSERT INTO gebaeude (gebaeude) VALUES ('$_POST[gebaeudeName]')";
    if ($conn->query($sql) == FALSE)
    {
    echo "Fehler beim Einfügen: " . $conn->error;
    }
  }

  else
  {
    echo "Fehler beim Einfügen: Einige Eingabefelder sind leer";
  }
  
}
echo "</div>"
?>
