<?php
include "connection.php";
include "navbar.php";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=container>";
echo "<h1>Futter</h1>";
$query = "SELECT futter.f_id, futter, gebaeude.gebaeude FROM futter, gebaeude WHERE futter.geb_id=gebaeude.geb_id";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $futter[] = $row['futter'];
  $futterID[] = $row['f_id'];
  $gebaeude[] = $row['gebaeude'];
}


echo "<table class='table'><tr><th scope='col'>Nr.</th><th>Futter</th><th>Gebäude</th></tr>";

for ($i = 0; $i < $count; $i++) {
  $number = $i;
  $number++;
  echo "<tr>";
  echo "<th scope='row'>$number</th>";
  echo "<td>$futter[$i]</td>";
  echo "<td>$gebaeude[$i]</td>";
  echo "<td><a href='?delete=$futterID[$i]' class='btn btn-danger'>Löschen</a></td>";
  echo "</tr>";
}
echo "</table>";


$query = "SELECT * FROM gebaeude";
$result = mysqli_query($conn, $query);
$countGebaeude = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $gebaeudeIdDrop[] = $row['geb_id'];
  $gebaeudeDrop[] = $row['gebaeude'];
}


?>

<html>
<h1>Futter hinzufügen</h1>
<form method="post">
  <label class="form-label">Futter:</label><br>
  <input class="form-control" type="text" name="futter"></input><br>
  <label class="form-label">Gebäude</label><br>
  <select class="form-control" name="gebaeudeSelect">
    <?php
    for ($i = 0; $i < $countGebaeude; $i++) {
      echo "<option value='$gebaeudeIdDrop[$i]'>$gebaeudeDrop[$i]</option>";
    }
    ?>
  </select><br><br>
  <button class="btn btn-primary" type="submit" name="speichern">Speichern</button>
</form>

</html>

<?php
if (isset($_POST["speichern"])) {
  if (!empty($_POST['futter']) && !empty($_POST['gebaeudeSelect'])) {
    $sql = "INSERT INTO futter (futter, geb_id) VALUES ('$_POST[futter]','$_POST[gebaeudeSelect]')";
    if ($conn->query($sql) == FALSE) {
      echo "Fehler beim Einfügen: " . $conn->error;
    } else {
      echo "<meta http-equiv='refresh' content='0'>";
    }
  } else {
    echo "Fehler beim Einfügen: Einige der Eingabefelder sind leer";
  }
}


if (isset($_GET["delete"])) {
  $id = $_GET["delete"];
  $sql = "DELETE FROM futter WHERE f_id=$id";
  if ($conn->query($sql) == FALSE) {

    echo "Fehler beim Löschen: " . $conn->error;
  } else {
    echo '<meta http-equiv="refresh" content="0;url=futter.php" />';
  }
}

echo "</div>"
?>