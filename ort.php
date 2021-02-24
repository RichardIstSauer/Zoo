<?php
include "connection.php";
include "navbar.php";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=container>";
echo "<h1>Orte</h1>";
$query = "SELECT `ort`,`plz` FROM `ort`";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $ort[] = $row['ort'];
  $plz[] = $row['plz'];
}

echo "<div class='row'>";
echo "<div class='col-md'>";
echo"<table class='table table-bordered'><tr><th scope='col'>Nr.</th><th>Ort</th><th>PLZ</th></th><th class='actions' colspan='2'>Aktionen</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  $number = $i;
  $number++;
  echo"<tr>";
  echo "<th scope='row'>$number</th>";
  echo "<td>$ort[$i]</td>";
  echo "<td>$plz[$i]</td>";
  echo "<td><button type='button' class='btn btn-warning'>Bearbeiten</button></td>";
  echo "<td><button type='button' class='btn btn-danger'>Löschen</button></td>";
  echo"</tr>";
}
echo"</table>";
echo "</div>";
echo "<div class='col-md'>";
echo "</div>";


echo "</div>";

?>
<div class="row">
    <div class="col-sm">
    
<form method="post">
  <div class="mb-3">
    <label class="form-label">Ortsname</label>
    <input type="text" class="form-control" name="ort">
  </div>
  <div class="mb-3">
    <label  class="form-label">PLZ</label>
    <input type="number" class="form-control" name="plz_ort" min="01067" max="99999">
  </div>
  <button type="submit" class="btn btn-primary" name="speichern">Speichern</button>
</form>
      
    </div>

    <div class="col-sm">

    </div>

    <div class="col-sm">
      
    </div>
  </div>

<?php

if (isset($_POST["speichern"]))
{
  if (!empty($_POST['ort']) && !empty($_POST['plz_ort']))
  {
    $sql = "INSERT INTO ort (ort, plz) values ('$_POST[ort]','$_POST[plz_ort]')";
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
