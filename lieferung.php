<?php
include "connection.php";
include "navbar.php";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=container>";
echo "<h1>Lieferung</h1>";
$query = "SELECT lieferung.lief_id, futter.futter, lieferant.lieferant, lieferung.liefdat, lieferung.menge, lieferung.einheit FROM futter, lieferant, lieferung WHERE lieferung.f_id=futter.f_id AND lieferant.l_id=lieferung.l_id;";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $futter[] = $row['futter'];
  $lieferant[] = $row['lieferant'];
  $lieferungsID[] = $row['lief_id'];
  $liefdat[] = $row['liefdat'];
  $menge[] = $row['menge'];
  $einheit[] = $row['einheit'];
}


echo "<table class='table'><tr><th scope='col'>Nr.</th><th>Futter</th><th>Lieferant</th><th>Lieferungsdatum</th><th>Menge</th><th>Einheit</th></tr>";

for ($i = 0; $i < $count; $i++) {
  $number = $i;
  $number++;
  echo "<tr>";
  echo "<th scope='row'>$number</th>";
  echo "<td>$futter[$i]</td>";
  echo "<td>$lieferant[$i]</td>";
  echo "<td>$liefdat[$i]</td>";
  echo "<td>$menge[$i]</td>";
  echo "<td>$einheit[$i]</td>";
  echo "<td><a href='?delete=$lieferungsID[$i]' class='btn btn-danger'>Löschen</a></td>";
  echo "</tr>";
}
echo "</table>";

$query = "SELECT * FROM lieferant";
$result = mysqli_query($conn, $query);
$countLieferant = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $lieferantDrop[] = $row['lieferant'];
  $lieferantIdDrop[] = $row['l_id'];
}

$query = "SELECT * FROM futter";
$result = mysqli_query($conn, $query);
$countFutter = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $futterDrop[] = $row['futter'];
  $futterIdDrop[] = $row['f_id'];
}

?>

<html>

<h1>Lieferung hinzufügen</h1>
<form method="post">
  <label class="form-label">Futter:</label><br>
  <select class="form-control" name="futterSelect">
    <?php
    for ($i = 0; $i < $countFutter; $i++) {
      echo "<option value='$futterIdDrop[$i]'>$futterDrop[$i]</option>";
    }
    ?>
  </select><br>
  <label class="form-label">Lieferant: </label><br>
  <select class="form-control" name="lieferantSelect">
    <?php
    for ($i = 0; $i < $countLieferant; $i++) {
      echo "<option value='$lieferantIdDrop[$i]'>$lieferantDrop[$i]</option>";
    }
    ?>
  </select><br>
  <label class="form-label">Lieferungsdatum: </label><br>
  <input class="form-control" type="date" name="lieferungsdatum"></input><br>
  <label class="form-label">Menge: </label><br>
  <input class="form-control" type="number" name="menge" min="1" max="10000"></input><br>
  <label class="form-label">Einheit: </label><br>
  <select class="form-control" name=einheit>
    <option value="mg">mg</option>
    <option value="g">g</option>
    <option value="kg">kg</option>
  </select><br>
  <button class="btn btn-primary" type="submit" name="speichern">Speichern</button>
</form>

</html>

<?php
if (isset($_POST["speichern"])) {
  if (!empty($_POST['futterSelect']) && !empty($_POST['lieferantSelect']) && !empty($_POST['lieferungsdatum']) && !empty($_POST['menge']) && !empty($_POST['einheit'])) {
    $sql = "INSERT INTO lieferung (f_id, l_id, liefdat, menge, einheit) VALUES ('$_POST[futterSelect]','$_POST[lieferantSelect]','$_POST[lieferungsdatum]','$_POST[menge]','$_POST[einheit]')";
    if ($conn->query($sql) == FALSE) {
      echo "Fehler beim Einfügen: " . $conn->error;
    } else {
      echo "<meta http-equiv='refresh' content='0'>";
    }
  } else {
    echo "Fehler beim Einfügen: Einige Eingabefelder sind leer";
  }
}

if (isset($_GET["delete"])) {
  $id = $_GET["delete"];
  $sql = "DELETE FROM lieferung WHERE lief_id=$id";
  if ($conn->query($sql) == FALSE) {

    echo "Fehler beim Löschen: " . $conn->error;
  } else {
    echo '<meta http-equiv="refresh" content="0;url=lieferung.php" />';
  }
}

echo "</div>"
?>