<?php
include "connection.php";
include "navbar.php";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=container>";
echo "<h1>Lieferant</h1>";
$query = "SELECT lieferant, ansprechpartner, telefonnummer, adresse, plz FROM lieferant";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $lieferant[] = $row['lieferant'];
  $ansprechpartner[] = $row['ansprechpartner'];
  $telefonnummerLieferant[] = $row['telefonnummer'];
  $adresseLieferant[] = $row['adresse'];
  $plzLieferant[] = $row['plz'];
}


echo "<table class='table table-bordered'><tr><th scope='col'>Nr.</th><th>Lieferant</th><th>Ansprechpartner</th><th>Telefonnummer</th><th>Adresse</th><th>PLZ</th></tr>";

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
  <label>Lieferant:</label><br>
  <input type="text" name="lieferant"></input><br>
  <label>Ansprechpartner: </label><br>
  <input type="text" name="ansprechpartner"></input><br>
  <label>Telefonnummer: </label><br>
  <input type="number" name="telefonnummerLieferant" min="1" max="99999999999999999"></input><br>
  <label>Adresse: </label><br>
  <input type="text" name="adresseLieferant"></input><br>
  <label>PLZ: </label><br>
  <select name=plzLieferantSelect>
    <?php
    for ($i = 0; $i < $count; $i++) {
      echo "<option value='$plzLieferantDrop[$i]'>$plzLieferantDrop[$i] - $ortLieferantDrop[$i]</option>";
    }
    ?>
  </select><br><br>
  <button type="submit" name="speichern">Speichern</button>
</form>

</html>

<?php
if (isset($_POST["speichern"])) {
  if (!empty($_POST['lieferant']) && !empty($_POST['ansprechpartner']) && !empty($_POST['telefonnummerLieferant']) && !empty($_POST['adresseLieferant']) && !empty($_POST['plzLieferantSelect'])) {
    $sql = "INSERT INTO lieferant (lieferant, ansprechpartner, telefonnummer, adresse, plz) VALUES ('$_POST[lieferant]','$_POST[ansprechpartner]','$_POST[telefonnummerLieferant]','$_POST[adresseLieferant]','$_POST[plzLieferantSelect]')";
    if ($conn->query($sql) == FALSE) {
      echo "Fehler beim Einfügen: " . $conn->error;
    }
  } else {
    echo "Fehler beim Einfügen: Einige Eingabefelder sind leer";
  }
}

echo "</div>"
?>