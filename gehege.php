<?php
include "connection.php";
include "navbar.php";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=container>";
echo "<h1>Gehege</h1>";
$query = "SELECT gehege.g_id, gehege.gehege, gebaeude.gebaeude FROM gehege, gebaeude WHERE gebaeude.geb_id = gehege.geb_id";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);


while ($row = mysqli_fetch_array($result)) {
  $gehegeID[] = $row['g_id'];
  $gehege[] = $row['gehege'];
  $gebaeude[] = $row['gebaeude'];
}


echo "<table class='table'><tr><th scope='col'>Nr.</th><th>Gehege</th><th>Gebäude</th></tr>";

for ($i = 0; $i < $count; $i++) {
  $number = $i;
  $number++;
  echo "<tr>";
  echo "<th scope='row'>$number</th>";
  echo "<td>$gehege[$i]</td>";
  echo "<td>$gebaeude[$i]</td>";
  echo "<td><a href='?delete=$gehegeID[$i]' class='btn btn-danger'>Löschen</a></td>";
  echo "</tr>";
}
echo "</table>";

$query = "SELECT * FROM gebaeude";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $gebaeudeDrop[] = $row['gebaeude'];
  $gebaeudeIdDrop[] = $row['geb_id'];
}

?>

<html>
<h1>Gehege hinzufügen</h1>
<form method="post">
  <label class="form-label">Gehege: </label><br>
  <input class="form-control" type="text" name="gehegeName"></input><br>
  <label class="form-label">Gebäude: </label><br>
  <select class="form-control" name=gebaeudeName>
    <?php
    for ($i = 0; $i < $count; $i++) {
      echo "<option value='$gebaeudeIdDrop[$i]'>$gebaeudeDrop[$i]</option>";
    }
    ?>
  </select><br><br>
  <button class="btn btn-primary" name="speichern">Speichern</button>
</form>

</html>

<?php
if (isset($_POST["speichern"])) {
  if (!empty($_POST['gehegeName']) && !empty($_POST['gebaeudeName'])) {
    $sql = "INSERT INTO gehege (gehege, gehege.geb_id) VALUES ('$_POST[gehegeName]', '$_POST[gebaeudeName]')";
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
  $sql = "DELETE FROM gehege WHERE g_id=$id";
  if ($conn->query($sql) == FALSE) {

    echo "Fehler beim Löschen: " . $conn->error;
  } else {
    echo '<meta http-equiv="refresh" content="0;url=gehege.php" />';
  }
}
echo "</div>";

?>