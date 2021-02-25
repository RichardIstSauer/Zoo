<?php
$query = "SELECT count(wochentag) AS num, wochentag, fuetterung.t_id, tier.tiername, tierart.tierart, futter.futter FROM futter, fuetterung, tier, tierart WHERE tier.art_id=tierart.art_id AND fuetterung.f_id=futter.f_id AND fuetterung.t_id=tier.t_id GROUP BY fuetterung.t_id, fuetterung.wochentag order by num desc";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result))
{
  $anzahlprotag[] = $row['num'];
  $wochentag[] = $row['wochentag'];
  $tiername[] = $row['tiername'];
  $futter[] = $row['futter'];

}

echo"<h2>Welches Tier bekommt mehrmals am Tag Futter und welches?</h2>";
echo"<table class='table'><tr><th scope='col'>Nr.</th><th>Häufigkeit pro Tag</th><th>Wochentag</th><th>Tiername</th><th>Futter</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  $number = $i;
  $number++;
  echo"<tr>";
  echo "<th scope='row'>$number</th>";
  echo "<td>$anzahlprotag[$i]X</td>";
  echo "<td>$wochentag[$i]</td>";
  echo "<td>$tiername[$i]</td>";
  echo "<td>$futter[$i]</td>";
  echo"</tr>";
}
echo"</table>";