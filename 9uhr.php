<?php
$query = "SELECT tier.tiername, gehege.gehege, tierart.tierart, futter.futter, fuetterung.wochentag, fuetterung.uhrzeit FROM fuetterung, tier, gehege, futter, tierart WHERE fuetterung.t_ID = tier.t_ID AND tier.art_id=tierart.art_id AND tier.g_id = gehege.g_id AND fuetterung.f_id=futter.f_id AND fuetterung.uhrzeit='09:00'";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result))
{
  $gehege[] = $row['gehege'];
  $tiername[] = $row['tiername'];
  $tierart[] = $row['tierart'];
  $futter[] = $row['futter'];
  $wochentag[] = $row['wochentag'];
  $uhrzeit[] = $row['uhrzeit'];
}

echo"<h2>Welches Tier erhält um 9:00 Uhr Futter?</h2>";
echo"<table class='table'><tr><th scope='col'>Nr.</th><th>Tiername</th><th>Gehege</th><th>Tierart</th><th>Futter</th><th>Wochentag</th><th>Uhrzeit</th></tr>";

for ($i = 0; $i < $count; $i++)
{
  $number = $i;
  $number++;
  echo"<tr>";
  echo "<th scope='row'>$number</th>";
  echo "<td>$tiername[$i]</td>";
  echo "<td>$gehege[$i]</td>";
  echo "<td>$tierart[$i]</td>";
  echo "<td>$futter[$i]</td>";
  echo "<td>$wochentag[$i]</td>";
  echo "<td>$uhrzeit[$i]</td>";
  echo"</tr>";
}
echo"</table>";
