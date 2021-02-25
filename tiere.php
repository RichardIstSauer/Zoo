<?php
include "connection.php";
include "navbar.php";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=container>";
echo "<h1>Tiere</h1>";
$query = "SELECT tier.t_id, tiername, tierart, reviername, gehege.gehege, geschlecht, gebdat, abgabedatum FROM tier, tierart, revier, gehege WHERE tier.art_id=tierart.art_id AND tier.r_id=revier.r_id AND tier.g_id=gehege.g_id";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $tiername[] = $row['tiername'];
  $tierart[] = $row['tierart'];
  $tierID[] = $row['t_id'];
  $revier[] = $row['reviername'];
  $gehege[] = $row['gehege'];
  $geschlecht[] = $row['geschlecht'];
  $gebdat[] = $row['gebdat'];
  $abgabedatum[] = $row['abgabedatum'];
}


echo "<table class='table'><tr><th scope='col'>Nr.</th><th>Name</th><th>Tierart</th><th>Revier</th><th>Gehege</th><th>Geschlecht</th><th>Geburtsdatum</th><th>Abgabedatum</th></tr>";

for ($i = 0; $i < $count; $i++) {
  $number = $i;
  $number++;
  echo "<tr>";
  echo "<th scope='row'>$number</th>";
  echo "<td>$tiername[$i]</td>";
  echo "<td>$tierart[$i]</td>";
  echo "<td>$revier[$i]</td>";
  echo "<td>$gehege[$i]</td>";
  echo "<td>$geschlecht[$i]</td>";
  echo "<td>$gebdat[$i]</td>";
  echo "<td>$abgabedatum[$i]</td>";
  echo "<td><a href='?delete=$tierID[$i]' class='btn btn-danger'>Löschen</a></td>";
  echo "</tr>";
}
echo "</table>";

$query = "SELECT * FROM revier";
$result = mysqli_query($conn, $query);
$countRevier = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $revierIdDrop[] = $row['r_id'];
  $revierDrop[] = $row['reviername'];
}

$query = "SELECT * FROM gehege";
$result = mysqli_query($conn, $query);
$countGehege = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $gehegeIdDrop[] = $row['g_id'];
  $gehegeDrop[] = $row['gehege'];
}

$query = "SELECT * FROM tierart";
$result = mysqli_query($conn, $query);
$countTierart = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $tierartIdDrop[] = $row['art_id'];
  $tierartDrop[] = $row['tierart'];
}

?>

<html>
<h1>Tier hinzufügen</h1>
<form method="post">
  <label class="form-label">Name:</label><br>
  <input class="form-control" type="text" name="name"></input><br>
  <label class="form-label">Tierart:</label><br>
  <select class="form-control" name="tierartSelect">
    <?php
    for ($i = 0; $i < $countTierart; $i++) {
      echo "<option value='$tierartIdDrop[$i]'>$tierartDrop[$i]</option>";
    }
    ?>
  </select><br>
  <label class="form-label">Revier</label><br>
  <select class="form-control" name="revierSelect">
    <?php
    for ($i = 0; $i < $countRevier; $i++) {
      echo "<option value='$revierIdDrop[$i]'>$revierDrop[$i]</option>";
    }
    ?>
  </select><br>
  <label class="form-label">Gehege</label><br>
  <select class="form-control" name="gehegeSelect">
    <?php
    for ($i = 0; $i < $countGehege; $i++) {
      echo "<option value='$gehegeIdDrop[$i]'>$gehegeDrop[$i]</option>";
    }
    ?>
  </select><br>
  <label class="form-label">Geschlecht:</label><br>
  <select class="form-control" name=geschlechtSelect>
    <option value="männlich">männlich</option>
    <option value="weiblich">weiblich</option>
  </select><br>
  <label class="form-label">Geburtsdatum: </label><br>
  <input class="form-control" type="date" name="gebdat"></input><br><br>
  <button class="btn btn-primary" type="submit" name="speichern">Speichern</button>
</form>

</html>

<?php
if (isset($_POST["speichern"])) {
  if (!empty($_POST['name']) && !empty($_POST['tierartSelect']) && !empty($_POST['revierSelect']) && !empty($_POST['gehegeSelect']) && !empty($_POST['geschlechtSelect']) && !empty($_POST['gebdat'])) {
    $sql = "INSERT INTO tier (tiername, art_id, r_id, g_id, geschlecht, gebdat) VALUES ('$_POST[name]','$_POST[tierartSelect]','$_POST[revierSelect]','$_POST[gehegeSelect]','$_POST[geschlechtSelect]','$_POST[gebdat]')";
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
  $sql = "DELETE FROM tier WHERE t_id=$id";
  if ($conn->query($sql) == FALSE) {

    echo "Fehler beim Löschen: " . $conn->error;
  } else {
    echo '<meta http-equiv="refresh" content="0;url=tiere.php" />';
  }
}

echo "</div>"
?>