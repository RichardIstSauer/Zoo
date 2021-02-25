<?php
include "connection.php";
include "navbar.php";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=container>";
echo "<h1>Pfleger</h1>";
$query = "SELECT * FROM pfleger";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $pflegerID[] = $row['pf_id'];
  $vornamePfleger[] = $row['vorname'];
  $nachnamePfleger[] = $row['nachname'];
  $gebdatPfleger[] = $row['geburtsdatum'];
  $adressePfleger[] = $row['adresse'];
  $telefonnummerPfleger[] = $row['telefonnummer'];
  $plzPfleger[] = $row['plz'];
}


echo "<table class='table'><tr><th scope='col'>Nr.</th><th>Vorname</th><th>Nachname</th><th>Geburtsdatum</th><th>Telefonnummer</th><th>Adresse</th><th>PLZ</th></tr>";

for ($i = 0; $i < $count; $i++) {
  $number = $i;
  $number++;
  echo "<tr>";
  echo "<th scope='row'>$number</th>";
  echo "<td>$vornamePfleger[$i]</td>";
  echo "<td>$nachnamePfleger[$i]</td>";
  echo "<td>$gebdatPfleger[$i]</td>";
  echo "<td>$telefonnummerPfleger[$i]</td>";
  echo "<td>$adressePfleger[$i]</td>";
  echo "<td>$plzPfleger[$i]</td>";
  echo "<td><a href='?delete=$pflegerID[$i]' class='btn btn-danger'>Löschen</a></td>";
  echo "</tr>";
}
echo "</table>";

$query = "SELECT * FROM ort";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $plzPflegerDrop[] = $row['plz'];
  $ortPflegerDrop[] = $row['ort'];
}

?>

<html>

<h1>Pleger hinzufügen</h1>
<form method="post">
  <label class="form-label">Vorname:</label><br>
  <input class="form-control" type="text" name="vorname"></input><br>
  <label class="form-label">Nachname: </label><br>
  <input class="form-control" type="text" name="nachname"></input><br>
  <label class="form-label">Geburtsdatum: </label><br>
  <input class="form-control" type="date" name="gebdat"></input><br>
  <label class="form-label">Telefonnummer: </label><br>
  <input class="form-control" type="number" name="telefonnummer" min="1" max="99999999999999999"></input><br>
  <label class="form-label">Adresse: </label><br>
  <input class="form-control" type="text" name="adresse"></input><br>
  <label class="form-label">PLZ: </label><br>
  <select class="form-control" name=plzPflegerSelect>
    <?php
    for ($i = 0; $i < $count; $i++) {
      echo "<option value='$plzPflegerDrop[$i]'>$plzPflegerDrop[$i] - $ortPflegerDrop[$i]</option>";
    }
    ?>
  </select><br>
  <button class="btn btn-primary" type="submit" name="speichern">Speichern</button>
</form>

</html>

<?php
if (isset($_POST["speichern"])) {
  if (!empty($_POST['vorname']) && !empty($_POST['nachname']) && !empty($_POST['gebdat']) && !empty($_POST['telefonnummer']) && !empty($_POST['adresse']) && !empty($_POST['plzPflegerSelect'])) {
    $sql = "INSERT INTO pfleger (vorname, nachname, geburtsdatum, telefonnummer, adresse, plz) VALUES ('$_POST[vorname]','$_POST[nachname]','$_POST[gebdat]','$_POST[telefonnummer]','$_POST[adresse]','$_POST[plzPflegerSelect]')";
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
  $sql = "DELETE FROM pfleger WHERE pf_id=$id";
  if ($conn->query($sql) == FALSE) {

    echo "Fehler beim Löschen: " . $conn->error;
  } else {
    echo '<meta http-equiv="refresh" content="0;url=pfleger.php" />';
  }
}

echo "</div>"
?>