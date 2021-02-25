<?php
include "connection.php";
include "navbar.php";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=container>";
echo "<h1>Lieferant</h1>";
$query = "SELECT * FROM lieferant";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $lieferantID[] = $row['l_id'];
  $lieferant[] = $row['lieferant'];
  $ansprechpartner[] = $row['ansprechpartner'];
  $telefonnummerLieferant[] = $row['telefonnummer'];
  $adresseLieferant[] = $row['adresse'];
  $plzLieferant[] = $row['plz'];
}


echo "<table class='table'><tr><th scope='col'>Nr.</th><th>Lieferant</th><th>Ansprechpartner</th><th>Telefonnummer</th><th>Adresse</th><th>PLZ</th></tr>";

for ($i = 0; $i < $count; $i++) {
  $number = $i;
  $number++;
  echo "<tr>";
  echo "<th scope='row'>$number</th>";
  echo "<td>$lieferant[$i]</td>";
  echo "<td>$ansprechpartner[$i]</td>";
  echo "<td>$telefonnummerLieferant[$i]</td>";
  echo "<td>$adresseLieferant[$i]</td>";
  echo "<td>$plzLieferant[$i]</td>";
  echo "<td><a href='?delete=$lieferantID[$i]' class='btn btn-danger'>Löschen</a></td>";
  echo "</tr>";
}
echo "</table>";

$query = "SELECT * FROM ort";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $plzLieferantDrop[] = $row['plz'];
  $ortLieferantDrop[] = $row['ort'];
}

?>

<html>

<h1>Lieferant hinzufügen</h1>
<form method="post">
  <label class="form-label">Lieferant:</label><br>
  <input class="form-control" type="text" name="lieferant"></input><br>
  <label class="form-label">Ansprechpartner: </label><br>
  <input class="form-control" type="text" name="ansprechpartner"></input><br>
  <label class="form-label">Telefonnummer: </label><br>
  <input class="form-control" type="number" name="telefonnummerLieferant" min="1" max="99999999999999999"></input><br>
  <label class="form-label">Adresse: </label><br>
  <input class="form-control" type="text" name="adresseLieferant"></input><br>
  <label class="form-label">PLZ: </label><br>
  <select class="form-control" name=plzLieferantSelect>
    <?php
    for ($i = 0; $i < $count; $i++) {
      echo "<option value='$plzLieferantDrop[$i]'>$plzLieferantDrop[$i] - $ortLieferantDrop[$i]</option>";
    }
    ?>
  </select><br>
  <button class="btn btn-primary" type="submit" name="speichern">Speichern</button>
</form>

</html>

<?php
if (isset($_POST["speichern"])) {
  if (!empty($_POST['lieferant']) && !empty($_POST['ansprechpartner']) && !empty($_POST['telefonnummerLieferant']) && !empty($_POST['adresseLieferant']) && !empty($_POST['plzLieferantSelect'])) {
    $sql = "INSERT INTO lieferant (lieferant, ansprechpartner, telefonnummer, adresse, plz) VALUES ('$_POST[lieferant]','$_POST[ansprechpartner]','$_POST[telefonnummerLieferant]','$_POST[adresseLieferant]','$_POST[plzLieferantSelect]')";
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
  $sql = "DELETE FROM lieferant WHERE l_id=$id";
  if ($conn->query($sql) == FALSE) {

    echo "Fehler beim Löschen: " . $conn->error;
  } else {
    echo '<meta http-equiv="refresh" content="0;url=lieferant.php" />';
  }
}


echo "</div>"
?>