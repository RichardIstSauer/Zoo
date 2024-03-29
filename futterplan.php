<?php
include "connection.php";
include "navbar.php";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=container>";
echo "<h1>Futterplan</h1>";
$query = "SELECT fuetterung.fuet_id, tier.tiername, tierart.tierart, revier.reviername, gehege.gehege, futter.futter, fuetterung.menge, fuetterung.einheit, fuetterung.uhrzeit, fuetterung.wochentag FROM revier, gehege, tier, fuetterung, tierart, futter WHERE fuetterung.t_id=tier.t_id AND revier.r_id=tier.r_id AND gehege.g_id=tier.g_id AND tier.art_id=tierart.art_id AND futter.f_id=fuetterung.f_id";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $tier[] = $row['tiername'];
  $tierart[] = $row['tierart'];
  $revier[] = $row['reviername'];
  $gehege[] = $row['gehege'];
  $futter[] = $row['futter'];
  $fuetterungsID[] = $row['fuet_id'];
  $menge[] = $row['menge'];
  $einheit[] = $row['einheit'];
  $uhrzeit[] = $row['uhrzeit'];
  $wochentag[] = $row['wochentag'];
}


echo "<table class='table'><tr><th scope='col'>Nr.</th><th>Tiername</th><th>Tierart</th><th>Revier</th><th>Gehege</th><th>Futter</th><th>Menge</th><th>Einheit</th></th><th>Uhrzeit</th></th><th>Wochentag</th></tr>";

for ($i = 0; $i < $count; $i++) {
  $number = $i;
  $number++;
  echo "<tr>";
  echo "<th scope='row'>$number</th>";
  echo "<td>$tier[$i]</td>";
  echo "<td>$tierart[$i]</td>";
  echo "<td>$revier[$i]</td>";
  echo "<td>$gehege[$i]</td>";
  echo "<td>$futter[$i]</td>";
  echo "<td>$menge[$i]</td>";
  echo "<td>$einheit[$i]</td>";
  echo "<td>$uhrzeit[$i]</td>";
  echo "<td>$wochentag[$i]</td>";
  echo "<td><a href='?delete=$fuetterungsID[$i]' class='btn btn-danger'>Löschen</a></td>";
  echo "</tr>";
}
echo "</table>";


$query = "SELECT tier.t_id, tiername, tierart, gehege.gehege FROM tier, tierart, gehege WHERE tier.art_id=tierart.art_id AND tier.g_id=gehege.g_id";
$result = mysqli_query($conn, $query);
$countTier = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $tierIdDrop[] = $row['t_id'];
  $gehegeDrop[] = $row['gehege'];
  $tierDrop[] = $row['tiername'];
  $tierartDrop[] = $row['tierart'];
}

$query = "SELECT * FROM futter";
$result = mysqli_query($conn, $query);
$countFutter = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $futterIdDrop[] = $row['f_id'];
  $futterDrop[] = $row['futter'];
}

?>

<html>
<h1>Geplante Fütterung hinzufügen</h1>
<form method="post">
  <label class="form-label">Tier:</label><br>
  <select class="form-control" name="tierSelect">
    <?php
    for ($i = 0; $i < $countTier; $i++) {
      echo "<option value='$tierIdDrop[$i]'>$tierDrop[$i], $gehegeDrop[$i] - $tierartDrop[$i]</option>";
    }
    ?>
  </select><br>
  <label>Futter:</label><br>
  <select class="form-control" name="futterSelect">
    <?php
    for ($i = 0; $i < $countFutter; $i++) {
      echo "<option value='$futterIdDrop[$i]'>$futterDrop[$i]</option>";
    }
    ?>
  </select><br>
  <label>Menge:</label><br>
  <input class="form-control" type="number" name="menge" min="1" max="10000"></input><br>
  <label>Einheit:</label><br>
  <select class="form-control" name="einheitSelect">
    <option value="mg">mg</option>
    <option value="g">g</option>
    <option value="kg">kg</option>
  </select><br>
  <label>Uhrzeit: </label><br>
  <input class="form-control" type="time" name="uhrzeit"></input><br>
  <label>Wochentag:</label><br>
  <select class="form-control" name=wochentagSelect>
    <option value="Montag">Montag</option>
    <option value="Dienstag">Dienstag</option>
    <option value="Mittwoch">Mittwoch</option>
    <option value="Donnerstag">Donnerstag</option>
    <option value="Freitag">Freitag</option>
    <option value="Samstag">Samstag</option>
    <option value="Sonntag">Sonntag</option>
  </select><br><br>
  <button class="btn btn-primary" type="submit" name="speichern">Speichern</button>
</form>

</html>

<?php
if (isset($_POST["speichern"])) {
  if (!empty($_POST['tierSelect']) && !empty($_POST['futterSelect']) && !empty($_POST['menge']) && !empty($_POST['einheitSelect']) && !empty($_POST['uhrzeit']) && !empty($_POST['wochentagSelect'])) {
    $sql = "INSERT INTO fuetterung (t_id, f_id, menge, einheit, uhrzeit, wochentag) VALUES ('$_POST[tierSelect]','$_POST[futterSelect]','$_POST[menge]','$_POST[einheitSelect]','$_POST[uhrzeit]','$_POST[wochentagSelect]')";
    if ($conn->query($sql) == FALSE) {
      echo "Fehler beim Einfügen: " . $conn->error;
    }
    else {
      echo "<meta http-equiv='refresh' content='0'>";
    }
  } else {
    echo "Fehler beim Einfügen: Einige der Eingabefelder sind leer";
  }
}


if (isset($_GET["delete"])) {
  $id = $_GET["delete"];
  $sql = "DELETE FROM fuetterung WHERE fuet_id=$id";
  if ($conn->query($sql) == FALSE) {

    echo "Fehler beim Löschen: " . $conn->error;
  } else {
    echo '<meta http-equiv="refresh" content="0;url=futterplan.php"/>';
  }
}



echo "</div>"
?>