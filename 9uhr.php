<?php
$query = "SELECT tier.tiername, gehege.gehege, tierart.tierart, futter.futter, fuetterung.wochentag, fuetterung.uhrzeit FROM fuetterung, tier, gehege, futter, tierart WHERE fuetterung.t_ID = tier.t_ID AND tier.art_id=tierart.art_id AND tier.g_id = gehege.g_id AND fuetterung.f_id=futter.f_id AND fuetterung.uhrzeit='09:00'";
$result = mysqli_query($conn, $query);
$count1 = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result))
{
  $gehege1[] = $row['gehege'];
  $tiername1[] = $row['tiername'];
  $tierart1[] = $row['tierart'];
  $futter1[] = $row['futter'];
  $wochentag1[] = $row['wochentag'];
  $uhrzeit1[] = $row['uhrzeit'];
}

echo"<h2>Welches Tier erhält um 9:00 Uhr Futter?</h2s>";
echo"<table class='table table-bordered''><tr><th scope='col'>Nr.</th><th>Tiername</th><th>Gehege</th><th>Tierart</th><th>Futter</th><th>Wochentag</th><th>Uhrzeit</th></tr>";

for ($i = 0; $i < $count1; $i++)
{
  $number = $i;
  $number++;
  echo"<tr>";
  echo "<th scope='row'>$number</th>";
  echo "<td>$tiername1[$i]</td>";
  echo "<td>$gehege1[$i]</td>";
  echo "<td>$tierart1[$i]</td>";
  echo "<td>$futter1[$i]</td>";
  echo "<td>$wochentag1[$i]</td>";
  echo "<td>$uhrzeit1[$i]</td>";
  echo"</tr>";
}
echo"</table>";
