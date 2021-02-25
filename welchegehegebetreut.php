<?php
echo "<h2>Welche Gehege betreut Pfleger x?</h2>";


$query = "SELECT * FROM pfleger";
$result = mysqli_query($conn, $query);
$countSelect = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $vorname [] = $row['vorname'];
  $nachname [] = $row['nachname'];
  $pflegerID [] = $row['pf_id'];
 
}

?>
<div class="row">
    <form method="post">
        <label class="form-label">Pfleger: </label><br>
        <select name=pfleger class="form-control" onchange="this.form.submit();">
        <?php
            for ($i = 0; $i < $countSelect; $i++) {
                echo "<option value='$pflegerID[$i]'>$vorname[$i],$nachname[$i]</option>";
            }
            ?>
        </select>
    </form>

</div>

<?php
$query = "SELECT vorname, nachname, gehege.gehege FROM pfleger, gehege, tier, einsatz WHERE einsatz.pf_id=pfleger.pf_id AND einsatz.r_id=tier.r_id AND gehege.g_id=tier.g_id AND einsatz.pf_id='$_POST[pfleger]'";
$result = mysqli_query($conn, $query);
$countTabelle = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
    $gehege [] = $row['gehege'];
    $vorname [] = $row['vorname'];
    $nachname [] = $row['nachname'];

   
}


echo "<table class='table'><tr><th scope='col'>Nr.</th><th>Gehege</th><th>Vorname</th><th>Nachname</th></tr>";

for ($i = 0; $i < $countTabelle; $i++) {
    $number = $i;
    $number++;
    echo "<tr>";
    echo "<th scope='row'>$number</th>";
    echo "<td>$gehege[$i]</td>";
    echo "<td>$vorname[$i]</td>";
    echo "<td>$nachname[$i]</td>";
    echo "</tr>";
}
echo "</table>";
