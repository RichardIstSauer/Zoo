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

echo "<h1>Revier</h1>";
$query = "SELECT `reviername` FROM `revier`";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $revier[] = $row['reviername'];
}


echo"<table style='width: 10%'><tr><th>Revier</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  echo"<tr>";
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
<button type="submit" name="speichern_revier" >Speichern</button> 
</form>


</html>

<?php
if (isset($_POST["speichern_revier"]))
{
  $sql = "INSERT INTO revier (reviername) VALUES ('".$_POST["reviername"]."')";
  if ($conn->query($sql) == FALSE)
  {
  echo "Fehler beim Einfügen: " . $conn->error;
  }
}
?>
