<?php
echo "<h2 class=' '>Wie viele Tiere sind in Gehege x?</h2>";


$query = "SELECT * FROM gehege";
$result = mysqli_query($conn, $query);
$countSelect = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
  $gehege [] = $row['gehege'];
  $gehegeID [] = $row['g_id'];

}

?>
<div class="row">
    <form method="post">
        <label class="form-label">Gehege: </label><br>
        <select name=gehege class="form-control" onchange="this.form.submit();">
        <?php
            for ($i = 0; $i < $countSelect; $i++) {
                echo "<option value='$gehegeID[$i]'>$gehege[$i]</option>";
            }
            ?>
        </select><br>
        <button type="submit" name="speichern" class="btn btn-primary">Auswählen</button>
    </form>

</div>

<?php
$query = "SELECT gehege.gehege, COUNT(tier.t_id) FROM tier, gehege WHERE gehege.g_id=tier.g_id AND tier.g_id='$_POST[gehege]'";
$result = mysqli_query($conn, $query);
$countTabelle = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
    $gehege[] = $row['gehege'];
    $tieranzahl[] = $row['COUNT(tier.t_id)'];
}


echo "<table class='table'><tr><th scope='col'>Nr.</th><th>Gehege</th><th>Tieranzahl</th></tr>";

for ($i = 0; $i < $countTabelle; $i++) {
    $number = $i;
    $number++;
    echo "<tr>";
    echo "<th scope='row'>$number</th>";
    echo "<td>$gehege[$i]</td>";
    echo "<td>$tieranzahl[$i]</td>";
    echo "</tr>";
}
echo "</table>";
