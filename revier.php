<?php
include "connection.php";
include "navbar.php";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=container>";
echo "<h1>Revier</h1>";
$query = "SELECT `reviername` FROM `revier`";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $revier[] = $row['reviername'];
}


echo"<table class='table'><tr><th scope='col'>Nr.</th><th>Revier</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  $number = $i;
  $number++;
  echo"<tr>";
  echo "<th scope='row'>$number</th>";
  echo "<td>$revier[$i]</td>";
  echo"</tr>";
}
echo"</table>";

?>

<html>

<h1>Revier hinzufügen</h1>
<form method="post">
<label>Reviername: </label><br>
<input type="text" name="reviername" ></input><br><br>
<button type="submit" name="speichern" >Speichern</button> 
</form>


</html>

<?php
if (isset($_POST["speichern"]))
{
  if (!empty($_POST['reviername']))
  {
    $sql = "INSERT INTO revier (reviername) VALUES ('$_POST[reviername]')";
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
