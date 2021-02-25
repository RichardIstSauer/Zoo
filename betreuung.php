<?php
include "connection.php";
include "navbar.php";
echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<script> if ( window.history.replaceState ) {window.history.replaceState( null, null, window.location.href ); } </script>";

echo "<div class=container>";
echo "<h1>Revier-Betreuung</h1>";
$query = "SELECT revier.reviername, pfleger.vorname, pfleger.nachname FROM revier, pfleger, einsatz WHERE revier.r_id=einsatz.r_id AND einsatz.pf_id=pfleger.pf_id;";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $revier[] = $row['reviername'];
  $vorname[] = $row['vorname'];
  $nachname[] = $row['nachname'];
}


echo"<table class='table'><tr><th scope='col'>Nr.</th><th scope='col'>Revier</th><th scope='col'>Vorname</th><th scope='col'>Nachname</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  $number = $i;
  $number++;
  echo"<tr>";
  echo "<th scope='row'>$number</th>";
  echo "<td>$revier[$i]</td>";
  echo "<td>$vorname[$i]</td>";
  echo "<td>$nachname[$i]</td>";
  echo"</tr>";
}
echo"</table>";

$query = "SELECT * FROM revier";
$result = mysqli_query($conn, $query);
$countRevier = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $revierDrop [] = $row['reviername'];
  $revierIdDrop [] = $row['r_id'];
  
}

$query = "SELECT * FROM pfleger";
$result = mysqli_query($conn, $query);
$countPfleger = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $vornameDrop [] = $row['vorname'];
  $nachnameDrop [] = $row['nachname'];
  $pflegerIdDrop [] = $row['pf_id'];
  
}


?>

<html>
<h1>Revier-Betreueung hinzufügen</h1>
<form method="post">
<label>Revier: </label><br>
<select name="revierSelect">
<?php
for ($i = 0; $i < $countRevier; $i++)
{
  echo "<option value='$revierIdDrop[$i]'>$revierDrop[$i]</option>";
}
?> 
</select><br>
<label>Pfleger: </label><br>
<select name="pflegerSelect">
<?php
for ($i = 0; $i < $countPfleger; $i++)
{
  echo "<option value='$pflegerIdDrop[$i]'>$vornameDrop[$i], $nachnameDrop[$i]</option>";
}



?> 
</select><br><br>
<button type="submit" name="speichern" >Speichern</button> 
</form>

</html>


<?php

if (isset($_POST["speichern"]))
{
  if (!empty($_POST['revierSelect']) && !empty($_POST['pflegerSelect']))
  {
    $sql = "INSERT INTO einsatz (r_id, pf_id) values ('$_POST[revierSelect]','$_POST[pflegerSelect]')";
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

echo "</div>";

?>
